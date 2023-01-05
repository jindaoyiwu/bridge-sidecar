<?php


use GuzzleHttp\RequestOptions;
use Hepburn\BridgeSidecar\Request\Http\Curl;

require "../../vendor/autoload.php";

try {
    $client = new Curl("http://127.0.0.1:7000", 3);
    $res = $client->post('isPostOk', [requestOptions::FORM_PARAMS =>[
        "name" => "cyz",
        "age" => 12,
        "month" => 2000000
    ]]);
    $resu = $res->getBody()->getContents();
    if ($resu) {
        var_dump($resu);
//        return $resu;
    } else {
        // todo
    }


    $res = $client->get('isOk', [requestOptions::QUERY => [
        "id" => 222,
        "age" => 12
    ]]);
    $resu = $res->getBody()->getContents();
    if ($resu) {
        var_dump($resu);
//        return $resu;
    } else {
        // todo
    }

    $res = $client->post('isPostJsonOk', [requestOptions::JSON =>[
        "name" => "cyz",
        "age" => 12,
        "month" => 2000000
    ]]);
    $resu = $res->getBody()->getContents();
    if ($resu) {
        var_dump($resu);
        return $resu;
    } else {
        // todo
    }
} catch (\Exception $e) {
    var_dump($e->getCode());
}
