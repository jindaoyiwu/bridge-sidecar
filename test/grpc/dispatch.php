<?php


use Hepburn\BridgeSidecar\Request\Grpc\Dispatch;

require "../../vendor/autoload.php";
var_dump('sss');
try {
    $client = new Dispatch("http://127.0.0.1:7000", 3);
    $msg = $client->call('all', 'test.isPostJsonOk', '{"name":"cyz","age":12,"month":2000000}}', 0, 'handle');
    var_dump($msg);
} catch (\Exception $e) {
    var_dump($e->getCode());
}
