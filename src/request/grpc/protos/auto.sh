#!/bin/bash

## 修改此处的protos
proto_name='./taskrpc.proto'
protoc -I=. --proto_path=$proto_name   --php_out=.   --grpc_out=.   --plugin=protoc-gen-grpc=/www/tmp/grpc/cmake/build/grpc_php_plugin $proto_name
#根据关键字找到相应的目录
namespace="php_namespace"
IFS=$'\n'
for line in $(cat $proto_name)
do
  result=$(echo $line | grep "${namespace}")
 if [[ "$result" != "" ]]; then
#   echo $line
   path1=${line#*\"}  # 从双引号出截取
#   echo $path1
   path2=${path1%\"*} # 从末尾双引号出截取
   echo $path2
   path3=${path2%%\\*} # 使用%号可以截取指定字符（或者子字符串）左边的所有字符 ${string%chars*} ${string%%chars*}
   path=${path2//\\\\/\/}
   move_to=${path##*\/}
   cp -r $path $move_to
   rm -rf $path3
   break
 fi
done