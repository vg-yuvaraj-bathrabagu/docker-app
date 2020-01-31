#!/bin/bash

set -e

# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - id
# ${6} - athena_database
# ${7} - athena_output
# ${8} - uuid
# ${9} - s3 region
# ${10} - absolute path to log file
# ${11} - path to s3 folder to upload log file
# ${12} - s3 presign duration
# ${13} - username


echo "uuid " ${12}
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE template SET \`forsync\` = 0, \`color\` = 'green' WHERE \`id\` = $5;
EOF
echo 0