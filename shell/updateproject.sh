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
# ${12} - auto increment project id
# ${13} - uuid
# ${14} - s3 region
# ${15} - s3 bucket
# ${16} - s3 presign duration
# ${17) - logged in username
# ${18} - accountid
# ${19} - absolute path to log file
# ${20} - path to s3 folder to upload log file
# ${21} - log file name
# ${22} - ID of user creating the project
# ${23} - type
# ${24} - sprintcount
# ${25} - sprintduration in weeks

echo "uuid " ${13}

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE project SET \`title\` = "$5", \`projectid\` = "$6", \`costcentercode\` = "$7", \`activity\` = "$8", \`laborpoline\` = "$9", \`odcpoline\` = "${10}", \`travelpoline\` = "${11}", \`type\` = "${23}", \`sprintcount\` = ${24}, \`sprintduration\` = ${25} WHERE \`id\` = ${12};
EOF
echo 0