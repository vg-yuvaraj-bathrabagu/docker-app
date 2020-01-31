#!/bin/bash

set -e
script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - name
# $6 - description
# $7 - username
# $8 - email
# $9 - uuid
# ${10} - s3 region
# ${11} - s3 bucket

echo "uuid" ${7}

# create the query for the athena table for the user
user_uuid=$(uuidgen | tr "[:upper:]" "[:lower:]")

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
INSERT INTO account (\`name\`, \`description\`,\`uuid\`,\`datecreated\`) VALUES ("$5", "$6", "$9", NOW());
EOF

# create the account folder on s3
aws s3api put-object --region "${10}" --bucket ${11} --key "$5/"

echo 0