#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - user
# $6 - project
# $7 - startdate
# $8 - enddate
# $9 - maxiumumhoursperday
# ${10} - maxiumumhoursperweek
# ${11} - saturdayworkallowed
# ${12} - sundayworkallowed
# ${13} - publicholiday work allowed
# ${14} - regular rate
# ${15} - overtime rate
# ${16} - approver name
# ${17} - approver email
# ${18} - auto increment id
# ${19} - uuid
# ${20} - s3 region
# ${21} - s3 bucket
# ${22} - s3 presign duration
# ${23) - logged in username
# ${25} - accountid
# ${26} - absolute path to log file
# ${27} - path to s3 folder to upload log file
# ${28} - log file name
# ${29} - ID of user creating the project

echo "uuid " ${13}

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE project_assignment SET \`startdate\` = "$7", \`enddate\` = "$8", \`maximumhoursperday\` = "$9",  \`maximumhoursperweek\` = "${10}",  \`saturdayworkallowed\` = "${11}",\`sundayworkallowed\` = "${12}",\`publicholidayworkallowed\` = "${13}", \`regularrate\`="${14}",\`overtimerate\` = "${15}",\`approvername\` = "${16}", \`approveremail\` = "${17}" WHERE \`id\` = ${18};
EOF
echo 0