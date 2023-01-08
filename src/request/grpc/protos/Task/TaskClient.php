<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Hepburn\BridgeSidecar\Request\Grpc\Protos\Task;

/**
 */
class TaskClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Hepburn\BridgeSidecar\Request\Grpc\Protos\Task\TaskRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Dispatch(\Hepburn\BridgeSidecar\Request\Grpc\Protos\Task\TaskRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/task.Task/Dispatch',
        $argument,
        ['\Hepburn\BridgeSidecar\Request\Grpc\Protos\Task\TaskResponse', 'decode'],
        $metadata, $options);
    }

}
