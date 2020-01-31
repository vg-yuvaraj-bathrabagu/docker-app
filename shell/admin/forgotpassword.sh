#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - reset_token (what is used to recover the account information to reset the password)
# $6 - uuid
# $7 - username
# $8 - email address
# $9 - s3 region
# ${10} - snstopic
# ${11} - password reset token
# ${12} - password reset message
# ${13} - subject

echo $@

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF

UPDATE app_user SET \`password_reset_token\` = "${11}" WHERE uuid = "$6";
EOF

# subscribe the user to all the sns topics: app-general, account and user
aws --region "$9" sns publish --topic-arn "${10}" --subject "${13}" --message "${12}"

echo 0