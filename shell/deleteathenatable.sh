#!/usr/bin/env bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config

# $1 - database
# $2 - region
# $3 - tablename
# $4 - output location
# $5 - logfile name

aws athena --region "$2" start-query-execution --query-string "drop table IF EXISTS $3" --query-execution-context Database="${1}" --output text --result-configuration "OutputLocation=$4" > "${5}".out
query_execution_id=`cat ${5}".out" | awk {'print $1'}`

START=`date "+%Y-%m-%d %H:%M"`
while true; do
    NOW=`date "+%Y-%m-%d %H:%M"`
      aws --region "$2" athena get-query-execution --query-execution-id "$query_execution_id" |grep State|egrep "SUCC|FAIL"
    if [ $? = 0 ]; then
        break
    fi
    aws athena --region "$2" get-query-execution --query-execution-id "$query_execution_id" |grep State
    echo "$START -- $NOW"
    sleep 1
done
END=`date "+%Y-%m-%d %H:%M"`
echo "Table $3 deleted from $1"