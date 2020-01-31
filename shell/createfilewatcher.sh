#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - title
# $6 - type
# $7 - description
# $8 - query string
# $9 - uuid
# ${10} - s3 region
# ${11} - s3 bucket
# ${12} - s3 presign duration
# ${13) - logged in username
# ${14} - accountid 
# ${15} - absolute path to log file
# ${16} - path to s3 folder to upload log file
# ${17} - log file name
# ${18} - securitypolicy
# ${19} - simulatonid
# ${20} - templateid
# ${21} - bucket
# ${22} - schedule

echo "uuid" $9

# use create a bucket directory if none is provided
s3_folder_url_complete="${21}"
if [ -z "$s3_folder_url_complete" ]
then
    s3_folder_url_complete="s3://${16}$9/"
fi

s3_url="$s3_folder_url_complete${17}"

# check if the simulation id is empty
simulationid="${19}"
if [ -z "$simulationid" ];
then
    simulationid="NULL"
fi

# check if the templateid is empty
templateid="${20}"
if [ -z "$templateid" ];
then
    templateid="NULL"
fi

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
INSERT INTO filewatcher (\`title\`, \`category\`, \`bucket\`, \`description\`, \`querystring\`, \`uuid\`, \`status\`, \`color\`, \`date\`, \`accountid\`, \`simulationid\`, \`templateid\`, \`securitypolicy\`, \`schedule\`) VALUES ("$5", "$6", "$s3_folder_url_complete", "$7", "$8", "$9", "Pending", "orange", NOW(), "${14}", $simulationid, $templateid, "${18}", "${22}");
EOF

# copy the log file to S3 
source $script_full_path"/"uploadtos3.sh "${10}" "${15}" "$s3_url"

# Presign the url to the file
https_url=`aws s3 presign "$s3_url" --expires-in ${12}`

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
UPDATE filewatcher set \`statusresult\` = '$https_url' where \`uuid\` = "$9";
EOF

echo 0