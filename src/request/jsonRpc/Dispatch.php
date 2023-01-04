<?php
namespace Hepburn\BridgeSidecar\Request\JsonRpc;

class JsonRPC
{
    private $conn;
    private int $timeOut;
    function __construct($host, $port, $timeOut=2)
    {
        $this->timeOut = $timeOut * 1000; // 毫秒
        $this->conn = fsockopen($host, $port, $errno, $errStr, $timeOut);
        if (!$this->conn) {
            // todo 记录错误日志
            // var_dump($errno, $errStr);
            return false;
        }
    }

    public function Call($method, $params)
    {
        if (!$this->conn) {
            return false;
        }
        $err = fwrite($this->conn, json_encode(array('method' => $method, 'params' => array($params), 'id' => 0,)) . "\n");
        if ($err === false) {
            return false;
        }
        stream_set_timeout($this->conn, 0, $this->timeOut);
        $line = fgets($this->conn);
        if ($line === false) {
            return NULL;
        }
        return json_decode($line, true);
    }
}

