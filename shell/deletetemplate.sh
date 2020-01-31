#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - template id
# $6 - tablename
# $7 - athena database
# $8 - athena output
# $9 - s3 region
# ${10} - template uuid
# ${11} - log file name
# ${12} - bucket input
# ${13} - bucket output
# ${14} - type of template
# ${15} - shared bucket input
# ${16} - shared bucket output

echo "uuid" $6


# delete the athena tables

for table in "$6" "$6"_u ; do
    aws athena --region "$9" start-query-execution --query-string "drop table IF EXISTS $table" --query-execution-context Database="${7}" --output text --result-configuration "OutputLocation=$8" > "${11}".out
    query_execution_id=`cat ${11}".out" | awk {'print $1'}`

    START=`date "+%Y-%m-%d %H:%M"`
    while true; do
        NOW=`date "+%Y-%m-%d %H:%M"`
          aws --region "$9" athena get-query-execution --query-execution-id $query_execution_id |grep State|egrep "SUCC|FAIL"
        if [ $? = 0 ]; then
            break
        fi
        aws athena get-query-execution --query-execution-id $query_execution_id |grep State
        echo "$START -- $NOW"
        sleep 1
    done
    END=`date "+%Y-%m-%d %H:%M"`
    echo "Table $table deleted from $7"

done;

# delete the files in the template directory
# delete the user files

source $script_full_path"/"deletefroms3.sh "$9" "${12}"
source $script_full_path"/"deletefroms3.sh "$9" "${13}"

# only delete shared templates for the Core type
if [ "Core" = "${14}" ];
then

source $script_full_path"/"deletefroms3.sh "$9" "${15}"
source $script_full_path"/"deletefroms3.sh "$9" "${16}"

fi;


# delete the template last so that it can be retried
mysql -h $1 --user=$2 --password=$3 $4 <<EOF
START TRANSACTION;
DELETE FROM fileupload WHERE \`templateid\` = $5;
DELETE FROM template WHERE \`id\` = $5;
COMMIT;
EOF
echo 0