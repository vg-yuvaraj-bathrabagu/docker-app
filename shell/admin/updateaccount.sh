#!/bin/bash

set -e
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - name
# $6 - description
# $7 - id
# $8 - uuid
# $9 - s3 region
# ${10} - s3 bucket
# ${11} - logfile name
# ${12} - dashboard url
# ${13} - current activity url
# ${14} - history activity url
# ${15} - sns general topic
# ${16} - sns topic prefix
# ${17} - account sns topic
# ${18} - account s3 folder
# ${19} - id of user who is updating the account
# ${20} - nexus report url

echo "id" $7
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE account SET \`description\` = "$6", \`dashboard_url\` = "${12}", \`current_activity_url\` = "${13}", \`history_activity_url\`= "${14}" , \`nexus_report_url\`= "${20}"WHERE \`id\` = $7;
EOF
echo 0