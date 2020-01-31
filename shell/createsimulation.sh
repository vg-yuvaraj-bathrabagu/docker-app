#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - title
# $6 - type
# $7 - description
# $8 - query string
# $9 - uuid
# ${10} - s3 region
# ${11} - s3 bucket
# ${12} - s3 presign duration
# ${13) - logged in username
# ${14} - accountid 
# ${15} - absolute path to log file
# ${16} - path to s3 folder to upload log file
# ${17} - log file name 

echo "uuid " ${9}
# note trailing / to mark it as a folder
s3_folder_url_complete="s3://${16}$9/"
s3_log_file_url="s3://${16}$9/${17}"

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
INSERT INTO simulation (\`title\`, \`category\`, \`bucket\`, \`description\`, \`querystring\`, \`uuid\`, \`status\`, \`color\`, \`date\`, \`accountid\`) VALUES ("$5", "$6", "$s3_folder_url_complete", "$7", "$8", "${9}", "Pending", "orange", NOW(), ${14});
EOF

# copy the log file to S3 
source $script_full_path"/"uploadtos3.sh "${10}" "${15}" "$s3_log_file_url"

# Presign the url to the file
https_url=`aws s3 presign "$s3_log_file_url" --expires-in ${12}`

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
UPDATE simulation set \`statusresult\` = '$https_url' where \`uuid\` = "$9";
EOF
echo 0