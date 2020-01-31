#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - filename
# $6 - current folder
# $7 - templateid
# $8 - source
# $9 - file size
# ${10} - uuid
# ${11} - uploaded by
# ${12) - logged in username
# ${13} - accountid
# ${14} - account name
# ${15} - s3 region
# ${16} - s3 bucket
# ${17} - s3 presign duration

file_name="$5.orc"
file_copy_to_parquet_result=`aws s3api --region "${15}" copy-object --bucket "${16}" --copy-source "${16}/$6$5" --key "$6$file_name" --output text`

# TODO: Move the results of the file copy to the status result column
mysql -v -v -h $1 --user=$2 --password=$3 $4  <<EOF
INSERT INTO fileupload (\`name\`, \`folder\`, \`templateid\`, \`source\`, \`size\`, \`uuid\`,\`status\`, \`color\`, \`date\`, \`uploadedby\`, \`statusresult\`, \`accountid\`) VALUES ("$file_name", "$6", "$7", "$8", "$9", "${10}", "Pending", "orange", NOW(), ${11}, "Copy to ORC completed", ${13});
EOF
echo 0
