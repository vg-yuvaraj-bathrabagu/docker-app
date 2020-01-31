#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - name
# $6 - description
# $7 - username
# $8 - email
# $9 - password
# ${10} - admin first name
# ${11} - admin last name
# ${12} - uuid
# ${13} - s3 region
# ${14} - s3 bucket
# ${15} - log file name
# ${16} - dashboard url
# ${17} - current activity url
# ${18} - history activity url
# ${19} - SNS general topic ARN
# ${20} - SNS topic prefix
# ${21} - account topic name
# ${22} - user topic name
# ${23} - s3 folder name for the account
# ${24} - userid of account creating this account
# {25} - nexus report url
# ${26} - cognito pool id
# ${27} - cognito pool client id
# ${28} - absolute path of log file
# ${29} - the user pool group to which users are to be added

echo $@

echo "uuid" ${10}

# account user admin uuid
user_uuid=$(uuidgen | tr "[:upper:]" "[:lower:]")

sns_account_topic=`aws --region "${13}" sns create-topic --name "${21}" --output text`
echo "The account topic arn is $sns_account_topic"

sns_user_topic=`aws --region "${13}" sns create-topic --name "${22}" --output text`
echo "The user topic arn is $sns_user_topic"

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
START TRANSACTION;

INSERT INTO account (\`name\`, \`description\`,\`uuid\`,\`datecreated\`, \`dashboard_url\`, \`current_activity_url\`, \`history_activity_url\`, \`snstopic\`, \`nexus_report_url\`) VALUES ("$5", "$6", "${12}", NOW(), "${16}", "${17}", "${18}", "$sns_account_topic", "${25}");

SET @account_id = LAST_INSERT_ID();

INSERT INTO app_user(\`firstname\`, \`lastname\`, \`credential_nickname\`,\`credential_password\`, \`account_id\`, \`credential_email\`, \`uuid\`, \`snstopic\`) VALUES("${10}", "${11}", "$7", PASSWORD("$9"), @account_id, "$8", "$user_uuid", "$sns_user_topic");

SET @user_id = LAST_INSERT_ID();

INSERT INTO user_role(\`user_id\`, \`role_name\`) VALUES (@user_id, 'ROLE_USER'), (@user_id, 'ROLE_ADMIN'), (@user_id, 'ROLE_DELETE_USER_DATA'), (@user_id, 'ROLE_DELETE_SHARED_DATA'), (@user_id, 'ROLE_RECOVER_USER_DATA'), (@user_id, 'ROLE_RECOVER_SHARED_DATA'), (@user_id, 'ROLE_CONVERSIONS'), (@user_id, 'ROLE_FILE_WATCHER'), (@user_id, 'ROLE_MODEL'), (@user_id, 'ROLE_FILE_UPLOAD'), (@user_id, 'ROLE_HADOOP'), (@user_id, 'ROLE_DATABASE'), (@user_id, 'ROLE_TABLES'), (@user_id, 'ROLE_QUERIES'), (@user_id, 'ROLE_TEMPLATE');

INSERT INTO \`project\` (\`projectid\`, \`title\`, \`accountid\`, \`uuid\`, \`createdby\`, \`datecreated\`, \`builtin\`) VALUES ('Vacation', 'Vacation', @account_id, UUID(), ${24}, NOW(), 1), ('Sick', 'Sick', @account_id, UUID(), ${24}, NOW(), 1), ("Public Holiday", "Public Holiday", @account_id, UUID(), ${24}, NOW(), 1);

COMMIT;
EOF

account_id_query="SELECT id FROM account WHERE uuid = '"${12}"'"

mysql -h $1 --user=$2 --password=$3 --skip-column-names -e "${account_id_query}" $4 > "${28}.account_id"
account_admin_uuid=`cat "${28}.account_id"`

# add the admin user account to cognito
aws cognito-idp --region "${13}" sign-up --client-id "${27}" --username "$8" --user-attributes=Name="custom:uuid",Value="${user_uuid}",Name=custom:accountid,Value="${account_admin_uuid}",Name="email",Value="$8" --password "$9"
aws cognito-idp admin-confirm-sign-up --user-pool-id "${26}" --username "$8"
# confirm the user account signup so that they can login
# add the user to the oncloudtime group
cognito_username=`aws cognito-idp --region "${13}" admin-get-user --user-pool-id "${26}" --username "$8" --output text --query 'Username'`
aws cognito-idp --region "${13}" admin-add-user-to-group --user-pool-id "${26}" --username "${cognito_username}" --group-name "${29}"
# add the inline policy for the user to enable their access to an S3 bucket

# create the account folder on s3
aws s3api put-object --region "${13}" --bucket ${14} --key "data/${23}/"

# subscribe the admin account to the following sns topics: app-general, account and user
aws --region "${13}" sns subscribe --topic-arn "${19}" --protocol email --notification-endpoint "$8"
aws --region "${13}" sns subscribe --topic-arn "$sns_account_topic" --protocol email --notification-endpoint "$8"
aws --region "${13}" sns subscribe --topic-arn "$sns_user_topic" --protocol email --notification-endpoint "$8"



echo 0