#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - id
# $6 - title
# $7 - category
# $8 - bucket
# $9 - description
# ${10} - querystring
# ${11} - athena_database name
# ${12} - athena_output location
# ${13} - uuid
# ${14} - s3 region
# ${15} - s3 bucket
# ${16} - absolute path to log file
# ${17} - path to s3 folder to upload log file
# ${18} - s3 presign duration
# $(19) - log file name

echo "# Run Model Results"
mysql -h $1 --user=$2 --password=$3 $4 <<EOF
UPDATE simulation SET \`status\` = 'Running', \`color\`='orange',  \`date\` = NOW(), \`statusresult\` = '' WHERE \`id\` = $5;
EOF
# sleep 120
echo "uuid" ${13}
# sleep 120
echo "$1" "$2" "$3" "$4" "$5" "$6" "$7" "$8" "$9" "${10}"
echo "11 - ${11}" "${12}" "${13}"
echo "16 - ${16}" "${17}" "${18}" "${19}"
#sleep 120
ls -altr
#sleep 120
# url to which the file will be copied
s3_url="s3://${17}${13}/${19}"
script_full_path=$(dirname "$0")
# copy the log file to S3
source $script_full_path"/"uploadtos3.sh "${14}" "${16}" "$s3_url"

# Presign the url to the file
https_url=`aws s3 presign "$s3_url" --expires-in ${18}`

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
UPDATE simulation SET \`status\` = 'Completed', \`color\`='green', \`date\` = NOW(), \`statusresult\` = '$https_url' WHERE \`id\` = $5;
EOF

echo "log file url $https_url"