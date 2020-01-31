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
# ${11} - aws key
# ${12} - aws secret
# ${13} - s3 region
# ${14} - s3 bucket
# ${15} - s3 presign duration
# ${16) - logged in username

echo "uuid " ${10}
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE simulation SET \`title\` = "$5", \`category\` = "$6", \`description\` = "$7", \`querystring\` = "$8" WHERE \`id\` = $9;
EOF
echo 0