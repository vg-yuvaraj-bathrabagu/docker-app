#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - task id
# $6 - task uuid
# $7 - path to query directory
# $8 - s3 region
# $9 - s3 bucket

echo "uuid " "$6" "with id" "$5"

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
DELETE FROM task WHERE \`id\` = $5;
EOF

echo 0