<?php

namespace Hepburn\BridgeSidecar\Request\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\requestOptions;

/**
 * 并发请求
 * Class ConcurrentCurl
 * @package Doraemon\tools
 */
class ConcurrentCurl
{
    const CURL_SETTLE_REQUEST_SUCCESS = 'fulfilled';
    public float $timeout = 2.0;

    /**
     * 发送客户端
     * @var object
     */
    public object $client;

    /**
     * @var array
     */
    public array $promises = [];

    /**
     * 打散后的请求结果,允许其中一个失败
     * @var array
     */
    public array $settle;

    /**
     * @var array
     */
    public array $uri;

    /**
     * @var string
     */
    public string $baseUri = '';

    /**
     * @var array
     */
    public array $header = [];
    /**
     * @var array
     */
    public array $cookies = [];

    /**
     * @var array
     */
    public array $params = [];


    /**
     * ConcurrentCurl constructor.
     * @param string $baseUri
     * @param float $timeout
     * @param array $header 如果需要比较版本号，最好要把主api接口的header传进来
     * @param array $cookies
     */
    public function __construct(string $baseUri = '', float $timeout = 2.0, array $header = [], array $cookies = [])
    {
        $this->baseUri = $baseUri;
        $this->timeout = $timeout;
        $this->header = $header;
        $this->cookies = $cookies;
        $this->client();
    }

    /**
     * 初始化发送端
     * @return void
     */
    private function client(): void
    {
        $data['timeout'] = $this->timeout;
        if (!empty($this->baseUri)) {
            $data['base_uri'] = $this->baseUri;
        }
        if (!empty($this->header)) {
            $data['headers'] = $this->header;
        }
        if (!empty($this->cookies)) {
            // 解析出域名
            $urlArr = parse_url($this->baseUri);
            $cookieJar = CookieJar::fromArray($this->cookies, $urlArr['host']);
            $data['cookies'] = $cookieJar;
        }
        $this->client = new Client($data);
    }

    /**
     *  发送get请求
     * @param $key
     * @param $uri
     * @param array $params
     * @return ConcurrentCurl
     */
    public function promiseGet($key, $uri, array $params = []): static
    {
        $this->uri[$key] = $uri;
        $this->params[$key] = $params;
        $this->promises[$key] = $this->client->getAsync($uri, $params);
        return $this;
    }

    /**
     * 发送post请求
     * @param $key
     * @param $uri
     * @param array $params
     * @return $this
     */
    public function promisePost($key, $uri, array $params = []): static
    {
        $this->uri[$key] = $uri;
        $this->params[$key] = $params;
        $this->promises[$key] = $this->client->postAsync($uri, $params);
        return $this;
    }

    /**
     * 等待返回结果，允许失败
     * @return $this
     */
    public function settle(): static
    {
        $this->settle = Utils::settle($this->promises)->wait();

        return $this;
    }

    /**
     * 获得具体内容，和settle() 配合使用
     * @param $key
     * @return array|mixed
     */
    public function settleContent($key): mixed
    {
        if ($this->settle[$key]['state'] == self::CURL_SETTLE_REQUEST_SUCCESS) {
            $response = $this->settle[$key]['value'];
            return json_decode($response->getBody()->getContents(), true);
        } else {
            // $handlerContext = $this->settle[$key]['reason']->getHandlerContext();
            return [];
        }
    }

    /**
     * 获取并发请求的数据
     * @param $key
     * @return array|mixed
     */
    public function getConcurrentResponseData($key): mixed
    {
        $rs = $this->settleContent($key);
        return $rs && $rs['code'] == 1 ? $rs['data'] : [];
    }

}
