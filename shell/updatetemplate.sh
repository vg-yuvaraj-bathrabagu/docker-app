#!/bin/bash

set -e

# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - id
# $6 - format
# $7 - table name
# $8 - delimiter
# $9 - samplerow
# ${10} - rules
# ${11} - athena_database
# ${12} - athena_output
# ${13} - uuid
# ${14} - s3 region
# ${15} - absolute path to log file
# ${16} - path to s3 folder to upload log file
# ${17} - s3 presign duration
# ${18} - username
# ${19} - bucket
# ${20} - comma delimited column definitions for athena
# ${21} - type
# ${22) - accountid
# ${23} - account name
# ${24} - log file name
# ${25} - userid
# ${26} - simulationid shown as model on the screen


echo "uuid " ${12}

simulationid="${26}"
if [ "" = "$simulationid" ];
then
    simulationid="NULL"
fi

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE template SET \`format\` = "$6", \`tablename\` = "$7", \`delimiter\` = "$8", \`samplerow\` = '$9', \`rules\` = '${10}', \`forsync\` = 1, \`color\` = 'orange', \`type\` = "${21}", \`simulationid\` = $simulationid WHERE \`id\` = $5;
EOF
echo 0