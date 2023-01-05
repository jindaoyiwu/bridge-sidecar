<?php


use Hepburn\BridgeSidecar\Request\Http\Curl;

require "../../vendor/autoload.php";

try {
    $client = new Curl("http://127.0.0.1:7000", 3);
//    $res = $client->post('isPostJsonOk', [
//        "name" => "cyz",
//        "age" => 12,
//        "month" => 2000000
//    ]);
//    $resu = $res->getBody()->getContents();
//    if ($resu) {
//        return $resu;
//    } else {
//        // todo
//    }


//    $res = $client->get('isOk', [
//        "id" => 222,
//        "age" => 12
//    ]);
//    $resu = $res->getBody()->getContents();
//    if ($resu) {
//        var_dump($resu);
//        return $resu;
//    } else {
//        // todo
//    }

    $res = $client->jsonPost('isPostJsonOk', [
        "name" => "cyz",
        "age" => 12,
        "month" => 2000000
    ]);
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
