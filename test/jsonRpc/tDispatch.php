<?php


namespace Hepburn\BridgeSidecar\Test\JsonRpc;


use Hepburn\BridgeSidecar\Request\JsonRpc\JsonRPC;
require "../../src/request/jsonRpc/Dispatch.php";
$client = new JsonRPC("127.0.0.1", 6000, 3);
$args = [
    'app' => 'all',
    "job_name" => "test.isPostJsonOk",
    "params" => [
        "method" => "post",
        "url" => "http://127.0.0.1:7000/isPostJsonOk?",
        "timeout" => 1,
        "params" => [
            "name" => "cyz",
            "age" => 12,
            "month" => 2000000
        ],
    ],
    "method" => "handle",
//    "delay" => 1671281669
    "delay" => 0
];
$r = $client->Call("Task.Dispatch", $args);
if (isset($r['result']['code']) && $r['result']['code'] == 200) {
    var_dump($r['result']);
} else {
    var_dump($r['error']);
}
