<?php


use GuzzleHttp\RequestOptions;
use Hepburn\BridgeSidecar\Request\Http\ConcurrentCurl;
require "../../vendor/autoload.php";

try {
    $client = new ConcurrentCurl("http://127.0.0.1:7000", 3.0,  );
    $client->promisePost('postJson','isPostJsonOk', [requestOptions::JSON =>[
        "name" => "cyz",
        "age" => 12,
        "month" => 2000000
    ]]);
    $client->promiseGet('isOk','isOk', [requestOptions::QUERY => [
        "id" => 222,
        "age" => 12
    ]]);
    $client->promisePost('post','isPostOk', [requestOptions::FORM_PARAMS =>[
        "name" => "cyz",
        "age" => 12,
        "month" => 2000000
    ]]);
    $client->settle();
    $resu = $client->settleContent('postJson');
    $resu2 = $client->settleContent('isOk');
    $resu3 = $client->settleContent('post');

        var_dump($resu, $resu2, $resu3);


} catch (\Exception $e) {
    var_dump($e->getCode());
}
