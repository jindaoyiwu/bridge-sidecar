<?php


use Hepburn\BridgeSidecar\Request\Http\ConcurrentCurl;
require "../../vendor/autoload.php";

try {
    $client = new ConcurrentCurl("http://127.0.0.1:7000", 3.0,  );
    $client->promiseJsonPost('postJson','isPostJsonOk', [
        "name" => "cyz",
        "age" => 12,
        "month" => 2000000
    ]);
    $client->promiseGet('isOk','isOk', [
        "id" => 222,
        "age" => 12
    ]);
    $client->settle();
    $resu = $client->settleContent('postJson');
    $resu2 = $client->settleContent('isOk');

        var_dump($resu, $resu2);


} catch (\Exception $e) {
    var_dump($e->getCode());
}
