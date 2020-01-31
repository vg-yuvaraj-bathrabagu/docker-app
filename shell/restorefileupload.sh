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
# $8 - uuid
# $9 - logged in username
# ${10} - account id
# ${11} - account name
# ${12} - s3 region
# ${13} - s3 bucket
# ${14} - s3 presign duration
# ${15} - new folder

echo "uuid ${8}"

file_copy_to_trash_result=`aws s3 --region "${12}" mv "s3://${13}/$6" "s3://${13}/${15}/" --recursive`
echo $file_copy_to_trash_result

mysql -v -v -h $1 --user=$2 --password=$3 $4  <<EOF
UPDATE fileupload SET \`trash\` = 0, \`folder\` = "${15}", \`color\`='orange', \`status\` = 'Pending' WHERE uuid = "${8}";
EOF
echo 0