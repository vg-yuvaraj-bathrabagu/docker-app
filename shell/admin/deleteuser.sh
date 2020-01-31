#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - id
# $6 - uuid
# $7 - username
# $8 - accountname
# $9 - s3 region
# ${10} - s3 bucket

echo "uuid" $6
mysql -h $1 --user=$2 --password=$3 $4 <<EOF
START TRANSACTION;
DELETE FROM user_role WHERE \`user_id\` = $5;

DELETE FROM app_user WHERE \`id\` = $5;
COMMIT;

EOF

# delete the user's s4 folder
aws s3api delete-object --region "$9" --bucket ${10} --key "data/$8/$7/"

echo 0