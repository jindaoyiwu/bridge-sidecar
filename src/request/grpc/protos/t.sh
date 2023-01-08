#!/bin/bash


file='./taskrpc.proto'
namespace="php_namespace"
IFS=$'\n'
for line in $(cat taskrpc.proto)
do
  result=$(echo $line | grep "${namespace}")
 if [[ "$result" != "" ]]; then
   path1=${line#*\"}
   path2=${path1%\"*}
   echo $path2
   sign='\\'
   sign2='/'
   path=${path2//\\\\/\/}
   move_to=${path##*\/}
   mv $path $move_to
   break
 fi
done