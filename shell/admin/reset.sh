#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config

# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - athena dabase
# $6 - bucket
# $7 - s3 region
# $8 - accountid
# $9 - account name
# ${10} - space delimited list of template tables
# ${11} - absolute path to log file

# File Watcher
echo "#Reset Application Data"
echo "* Delete file watcher"
mysql -h $1 --user=$2 --password=$3 $4 <<EOF
DELETE FROM filewatcher WHERE \`accountid\` = $8;
EOF

# Hadoop
echo "* Delete hadoop"
mysql -h $1 --user=$2 --password=$3 $4  <<EOF
DELETE FROM hadoop_status  WHERE \`accountid\` = $8;
EOF

# MPP Database
echo "* Delete MPP"
mysql -h $1 --user=$2 --password=$3 $4  <<EOF
DELETE FROM mpp_status  WHERE \`accountid\` = $8;
EOF


# Queries
echo "* Delete queries"
mysql -h $1 --user=$2 --password=$3 $4   <<EOF
DELETE FROM customreport  WHERE \`accountid\` = $8;
EOF

# Simulator
echo "* Delete simulator"
mysql -h $1 --user=$2 --password=$3 $4   <<EOF
DELETE FROM simulation  WHERE \`accountid\` = $8;
EOF

# File Uploads - deleted first due to a foreign key with templates
echo "* Delete fileuploads"
mysql -h $1 --user=$2 --password=$3 $4   <<EOF
DELETE FROM fileupload  WHERE \`accountid\` = $8;
EOF

# Delete tables from athena
for table in ${10} ; do
    aws athena --region "$7" start-query-execution --query-string "drop table IF EXISTS $table" --query-execution-context Database="${5}" --output text --result-configuration "OutputLocation=s3://$6/data/$9/" > "${11}".out
    query_execution_id=`cat ${11}".out" | awk {'print $1'}`

    START=`date "+%Y-%m-%d %H:%M"`
    while true; do
        NOW=`date "+%Y-%m-%d %H:%M"`
          aws --region "$7" athena get-query-execution --query-execution-id $query_execution_id |grep State|egrep "SUCC|FAIL"
        if [ $? = 0 ]; then
            break
        fi
        aws athena get-query-execution --query-execution-id $query_execution_id |grep State
        echo "$START -- $NOW"
        sleep 1
    done
    END=`date "+%Y-%m-%d %H:%M"`
    echo "Table $table deleted from $5"

done;

# Templates
echo "* Delete templates"
mysql -h $1 --user=$2 --password=$3 $4   <<EOF
DELETE FROM template  WHERE \`accountid\` = $8;
EOF

# Notifications
echo "* Delete notifications"
mysql -h $1 --user=$2 --password=$3 $4   <<EOF
DELETE FROM notification  WHERE user IN (SELECT credential_nickname FROM app_user WHERE \`account_id\` = $8);
EOF

# Delete from the user folder
echo "* Delete user files"
aws s3 --region ${7} rm s3://${6}/data/"$9"/ --recursive
aws s3 --region ${7} rm s3://${6}/trash/"$9"/ --recursive

# TODO: Add a command to purge the queue