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
# $8 - action
# $9 - file size
# ${10} - current file uuid
# ${11} - userid
# ${12} - logged in username
# ${13} - account id
# ${14} - account name
# ${15} - s3 region
# ${16} - s3 bucket
# ${17} - s3 presign duration
# ${18} - shared folder
# ${19} - new file uuid
# ${20} - template format

echo "uuid ${10}"
echo "format ${20}"

share_file_result=""
if [ 'Text' = "${20}" ];
then
    share_file_result=`aws s3 --region "${15}" cp "s3://${16}/$6$5" "s3://${16}/${18}$5"`
    echo $share_file_result
else
    # process the other formats copy directories instead of files
    share_file_result=`aws s3 --region "${15}" cp "s3://${16}/$6" "s3://${16}/${18}" --recursive`
    echo $share_file_result
fi

mysql -v -v -h $1 --user=$2 --password=$3 $4  <<EOF

INSERT INTO fileupload (\`name\`, \`folder\`, \`templateid\`, \`source\`, \`size\`, \`uuid\`,\`status\`, \`color\`, \`date\`, \`uploadedby\`, \`statusresult\`, \`accountid\`) SELECT \`name\`, "${18}", \`templateid\`, "$8", \`size\`, "${19}",'Pending', 'orange', NOW(), \`uploadedby\`, '', \`accountid\` FROM fileupload WHERE uuid = "${10}";
EOF
echo 0