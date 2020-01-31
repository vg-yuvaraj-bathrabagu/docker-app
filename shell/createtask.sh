#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - title
# $6 - project
# $7 - startdate
# $8 - enddate
# $9 - assignee
# ${10} - parent
# ${11} - istimesheettask
# ${12} - accountid
# ${13} - uuid
# ${14} - s3 region
# ${15} - s3 bucket
# ${16} - s3 presign duration
# ${17) - logged in username
# ${18} - absolute path to log file
# ${19} - path to s3 folder to upload log file
# ${20} - log file name
# ${21} - ID of user creating the task

echo "uuid " ${13}

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
INSERT INTO task (\`title\`, \`projectid\`, \`startdate\`, \`enddate\`, \`assigneeid\`,  \`parentid\`,  \`istimesheettask\`,\`accountid\`, \`uuid\`, \`createdby\`, \`datecreated\`) VALUES ("$5", $6, "$7", "$8", $9, ${10}, ${11}, "${12}","${13}", "${21}", NOW());
EOF

echo 0