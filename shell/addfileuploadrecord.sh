#!/bin/bash

set -e

# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - filename
# $6 - s3 folder path starts from the bucket, ends in a trailing slash
# $7 - templateid
# $8 - source (this will be CopyFromIntakeToTemplate) - may be used later
# $9 - file size in bytes
# ${10} - user id (numeric ID of the user who uploaded the file)

file_upload_uuid=$(uuidgen | tr "[:upper:]" "[:lower:]")

mysql -v -v -h $1 --user=$2 --password=$3 $4 <<EOF
INSERT INTO fileupload (\`name\`, \`folder\`, \`templateid\`, \`source\`, \`size\`, \`uuid\`,\`status\`, \`color\`, \`date\`, \`uploadedby\`) VALUES ("$5", "$6", "$7", "$8", "$9", "$file_upload_uuid", "Available", "orange", NOW(), ${10});
EOF
echo 0