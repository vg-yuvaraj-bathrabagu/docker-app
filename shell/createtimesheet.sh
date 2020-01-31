#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - userid
# $6 - start
# $7 - end
# $8 - accountid
# $9 - timesheetdetailsql
# ${10} - uuid
# ${11} - s3 region
# ${12} - s3 bucket
# ${13} - s3 presign duration
# ${14) - logged in username
# ${15} - absolute path to log file
# ${16} - path to s3 folder to upload log file
# ${17} - log file name
# ${18} - timesheet_detail_data

echo "timesheet detail data " ${18}
echo "sql $9"

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
START TRANSACTION;

INSERT INTO timesheet (\`userid\`, \`accountid\`, \`uuid\`, \`startdate\`, \`enddate\`, \`datecreated\`) VALUES ("$5", "$8", "${10}", "$6", "$7", NOW());

SET @timesheet_id = LAST_INSERT_ID();

$9

COMMIT;
EOF

echo 0