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
# ${18} - uuid
# ${19} - s3 region
# ${20} - s3 bucket
# ${21} - s3 presign duration
# ${22) - logged in username
# ${23} - accountid
# ${24} - absolute path to log file
# ${25} - path to s3 folder to upload log file
# ${26} - log file name
# ${27} - ID of user creating the project

echo "uuid " ${18}

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF

START TRANSACTION;

INSERT INTO project_assignment (\`userid\`, \`projectid\`, \`startdate\`, \`enddate\`, \`maximumhoursperday\`,  \`maximumhoursperweek\`,  \`saturdayworkallowed\`,\`sundayworkallowed\`,\`publicholidayworkallowed\`, \`regularrate\`,\`overtimerate\`,\`approvername\`, \`approveremail\`, \`uuid\`, \`accountid\`, \`createdby\`, \`datecreated\`) VALUES ("$5", "$6", "$7", "$8", "$9", "${10}", "${11}", "${12}","${13}","${14}","${15}","${16}","${17}","${18}","${23}", "${27}", NOW());

INSERT INTO project_rate(\`accountid\`, \`userid\`, \`projectid\`, \`startdate\`, \`enddate\`,  \`createdby\`, \`uuid\`) VALUES("${23}","$5", "$6","$7", "$8","${27}", UUID());

COMMIT;
EOF

echo 0