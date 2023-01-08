<?php

namespace Hepburn\BridgeSidecar\Request\Grpc;

use Hepburn\BridgeSidecar\Request\Grpc\Protos\Task\TaskClient;
use Hepburn\BridgeSidecar\Request\Grpc\Protos\Task\TaskRequest;

class Dispatch
{
    private TaskClient $client;
    function __construct($host, $port, $timeOut = 2)
    {
        $timeOut = $timeOut * 1000;
        $this->client = new TaskClient($host . ':' . $port, [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
            'timeout' => $timeOut,
        ]);
    }

    public function call($app, $jobName, $params, $delay, $method)
    {
        $request = new TaskRequest();
        $request->setApp($app);
        $request->setJobName($jobName);
        $request->setParams($params);
        $request->setDelay($delay);
        $request->setMethod($method);
        list($reply, $status) = $this->client->Dispatch($request)->wait();
        return $reply->getMessage();
    }
}

