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
# ${15) -  type

echo "uuid" ${10}
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE customreport SET \`title\` = "$5", \`category\` = "$6", \`description\` = "$7", \`querystring\` = "$8", \`type\`="${15}" WHERE \`id\` = $9;
EOF
echo 0