#!/bin/bash

set -e

# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - title
# $6 - type
# $7 - description
# $8 - query string
# $9 - id
# ${10} - uuid
# ${11} - s3 region
# ${12} - s3 bucket
# ${13} - s3 presign duration
# ${14) - logged in username
# ${15} - accountid
# ${16} - absolute path to log file
# ${17} - path to s3 folder to upload log file
# ${18} - log file name
# ${19} - securitypolicy
# ${20} - simulatonid
# ${21} - templateid
# ${22} - bucket
# ${23} - schedule

echo "uuid" ${10}

# use create a bucket directory if none is provided
s3_folder_url_complete="${22}"
if [ -z "$s3_folder_url_complete" ]
then
    s3_folder_url_complete="s3://${17}${10}/"
fi

s3_url="$s3_folder_url_complete${17}"

# check if the simulation id is empty
simulationid="${20}"
if [ -z "$simulationid" ];
then
    simulationid="NULL"
fi

# check if the templateid is empty
templateid="${21}"
if [ -z "$templateid" ];
then
    templateid="NULL"
fi

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE filewatcher SET \`title\` = "$5", \`category\` = "$6", \`description\` = "$7", \`querystring\` = "$8", \`bucket\` = "$s3_folder_url_complete", \`templateid\` = $templateid, \`simulationid\` = $simulationid, \`securitypolicy\` = "${21}", \`schedule\` = "${23}" WHERE \`id\` = $9;
EOF
echo 0