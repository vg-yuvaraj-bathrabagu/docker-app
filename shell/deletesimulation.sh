#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - simulation id
# $6 - simulation uuid
# $7 - path to query directory
# $8 - s3 region
# $9 - s3 bucket

echo "uuid" $6 "$7" "$8" "$9"

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
DELETE FROM simulation WHERE \`id\` = $5;
EOF

# delete the simulation directory
source $script_full_path"/"deletefroms3.sh "$8" "s3://$7$6/"
echo 0