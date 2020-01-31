#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - numeric id
# $6 - uuid
# ${7} - aws key
# ${8} - aws secret
# ${9} - s3 region
# ${10} - absolute path to log file
# ${11} - path to s3 folder to upload log file
# ${12} - s3 presign duration
# ${13} - log file name

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
UPDATE mpp_status set \`status\` = 'Stopping', \`ts_begin\` = NOW(), \`color\` = 'orange', \`comments\` = CONCAT('stop started at ', ' ', NOW()), \`statusresult\` = '' where id = $5;
EOF
echo "uuid" $6
# url to which the file will be copied
s3_url="s3://${11}$6/${13}"
# copy the log file to S3
source $script_full_path"/"uploadtos3.sh "$9" "${10}" "$s3_url"

# Presign the url to the file
https_url=`aws s3 presign "$s3_url" --expires-in ${12}`

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
UPDATE mpp_status set \`status\` = 'Stopped', \`ts_begin\` = NOW(), \`color\` = 'red',\`comments\` = CONCAT('completed at ', ' ', NOW()), \`statusresult\` = '$https_url' where id = $5;
EOF
echo 0;

