#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - title
# $6 - projectid
# $7 - costcentercode
# $8 - activity
# $9 - laborpoline
# ${10} - odcpoline
# ${11} - travelpoline
# ${12} - uuid
# ${13} - s3 region
# ${14} - s3 bucket
# ${15} - s3 presign duration
# ${16) - logged in username
# ${17} - accountid
# ${18} - absolute path to log file
# ${19} - path to s3 folder to upload log file
# ${20} - log file name
# ${21} - ID of user creating the project
# ${22} - type
# ${23} - sprintcount
# ${24} - sprintduration in weeks


echo "uuid " ${12}

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
INSERT INTO project (\`title\`, \`projectid\`, \`costcentercode\`, \`activity\`, \`laborpoline\`,  \`odcpoline\`,  \`travelpoline\`, \`uuid\`, \`accountid\`, \`createdby\`, \`datecreated\`, \`type\`, \`sprintcount\`,\`sprintduration\`) VALUES ("$5", "$6", "$7", "$8", "$9", "${10}", "${11}", "${12}", "${17}", "${21}", NOW(), "${22}", ${23}, ${24});
EOF

echo 0