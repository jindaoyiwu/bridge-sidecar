<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: taskrpc.proto

namespace Hepburn\BridgeSidecar\Request\Grpc\Protos\Task;

class Taskrpc
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�
taskrpc.prototask"Z
TaskRequest
app (	
jobName (	
params (	
delay (
method (	"�
TaskResponse
code (
message (	*
data (2.task.TaskResponse.DataEntry+
	DataEntry
key (	
value (	:82;
Task3
Dispatch.task.TaskRequest.task.TaskResponse" BnZ
./packages�.Hepburn\\BridgeSidecar\\Request\\Grpc\\Protos\\Task�.Hepburn\\BridgeSidecar\\Request\\Grpc\\Protos\\Taskbproto3'
        , true);

        static::$is_initialized = true;
    }
}

