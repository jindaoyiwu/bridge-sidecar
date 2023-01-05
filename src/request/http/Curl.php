<?php

namespace Hepburn\BridgeSidecar\Request\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\RequestOptions;

class Curl
{
    public float $timeout = 2.0;

    /**
     * 发送客户端
     * @var object
     */
    public object $client;


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
     * @param $uri
     * @param array $params
     * @return mixed
     */
    public function get($uri, array $params = []): mixed
    {
        return $this->client->get($uri, $params);
    }

    /**
     * 发送post请求
     * @param $uri
     * @param array $params
     * @return mixed
     */
    public function post($uri, array $params = []): mixed
    {
        return $this->client->post($uri, $params);
    }


}