#!/usr/bin/env bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config

# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - aws key
# $6 - aws secret
# $7 - athena directory
# $8 - athena database
# $9 - athena input
# ${10} - athena output
# ${11} - sqs queue
# ${12} - s3 bucket
# ${13} - need_update
# ${14} - sns topic arn
# ${15} - s3 region
# ${16} - absolute path to log file
# ${17} - 1 specifies whether to reset the database
# {18}- cognito_pool_id
# {19) - cognito pool client id
# ${20} - cognito pool group name
# ${21} - cognito user pool name
# ${22} - cognito iam role name
# ${23} - client app name
# ${24} - default user password

echo $@
echo "Starting installation"

# Create S3 bucket
aws s3api create-bucket --bucket "${12}" --region "${15}"
echo "S3 bucket created"

# Create Athena database
athena_log_file_absolute_path="${16}.athena"
# run the athena query
aws athena --region "${15}" start-query-execution  --query-string "CREATE DATABASE IF NOT EXISTS $8" --result-configuration OutputLocation="${10}" --output text > ${16}".out"
query_execution_id=`cat ${16}".out" | awk {'print $1'}`

START=`date "+%Y-%m-%d %H:%M"`
count=0
while true; do
    NOW=`date "+%Y-%m-%d %H:%M"`
      query_status=$(aws --region "${15}" athena get-query-execution --query-execution-id "$query_execution_id" | grep State |sed 's: ::g')
      query_status_exit_code=$?
      echo "The query execution exit code is $query_status_exit_code and $query_status"
    if [ $? = 0 ]; then
        # no errors have occured now check if the run has succeeded or failed
        case $query_status in
         *"SUCCEEDED"*)
            break;;
        *"FAILED"*)
            raise error "Query Execution Failed";;
        *"RUNNING"*)
            # do nothing
            echo "The query is still running"
        esac

    else
         raise error "Error occured while executing the query - $query_execution_status"
    fi
    # aws --region "${14}" athena get-query-execution --query-execution-id "$query_execution_id"|grep State
    ((count=$count+1))
    echo "$count"
    echo "$START -- $NOW"
    sleep 1
done
END=`date "+%Y-%m-%d %H:%M"`
echo "Athena output file $athena_log_file_absolute_path"
aws athena --region "${15}" get-query-results --query-execution-id $query_execution_id --no-paginate --output json > "$athena_log_file_absolute_path"

echo "Athena directory created"

if [ "1" = "${17}" ];
then
    # run the new database script
    echo "Resetting the database"
    mysql -h $4 --user=$1 --password=$2 $3 < "$script_full_path/../../sql/new_install.sql"
fi

# Clear and warmup the application cache
# "${script_full_path}"/../../bin/console cache:clear --env=prod
# "${script_full_path}"/../../bin/console cache:warmup

# create a nexus database if it does not exist
athena_log_file_absolute_path_state_guide="${16}stateguide.athena"
state_guide_table_input_location="s3://${12}/app/nexus/stateguide/intake/"
state_guide_table_output_location="s3://${12}/app/nexus/stateguide/output/"
# run the athena query
aws athena --region "${15}" start-query-execution  --query-string "create external table IF NOT EXISTS stateguide (id int, accountid int, state string, code string, effectivedate date, salestransactionsthreshold int, salesdollarsthreshold double, nearingtransactioncountthreshold int, nearingsalesthreshold double, createdby string, datecreated string, lastupdatedby string, lastupdatedate string, uuid string) ROW FORMAT DELIMITED FIELDS TERMINATED BY ',' LOCATION '$state_guide_table_input_location';" --result-configuration OutputLocation="${state_guide_table_output_location}" --query-execution-context Database="$8" --output text > ${16}"stateguide.out"
query_execution_id_state_guide=`cat ${16}"stateguide.out" | awk {'print $1'}`

START=`date "+%Y-%m-%d %H:%M"`
count=0
while true; do
    NOW=`date "+%Y-%m-%d %H:%M"`
      query_stateguide_status=$(aws --region "${15}" athena get-query-execution --query-execution-id "$query_execution_id_state_guide" | grep State |sed 's: ::g')
      query_stateguide_status_exit_code=$?
      echo "The query execution exit code for nexus is $query_stateguide_status_exit_code and $query_stateguide_status"
    if [ $? = 0 ]; then
        # no errors have occured now check if the run has succeeded or failed
        case $query_stateguide_status in
         *"SUCCEEDED"*)
            break;;
        *"FAILED"*)
            raise error "Query Execution Failed";;
        *"RUNNING"*)
            # do nothing
            echo "The query is still running"
        esac

    else
         raise error "Error occured while executing the query - $query_stateguide_execution_status"
    fi
    # aws --region "${14}" athena get-query-execution --query-execution-id "$query_execution_id"|grep State
    ((count=$count+1))
    echo "$count"
    echo "$START -- $NOW"
    sleep 1
done
END=`date "+%Y-%m-%d %H:%M"`
echo "Athena output file $athena_log_file_absolute_path_state_guide"
aws athena --region "${15}" get-query-results --query-execution-id "$query_execution_id_state_guide" --no-paginate --output json > "$athena_log_file_absolute_path_state_guide"

echo "State guide table created"
echo "Uploading the state guide file to S3"
  aws s3 --region ${15} cp "$script_full_path/../../data/state_guide.csv" "$state_guide_table_input_location"

INSTALL_YAML_FILE="$script_full_path/../../config/install/install.yaml"

# setup the Cognito authentication
COGNITO_POOL_ID_FILE="${16}.aws_cognito_pool_id"
COGNITO_POOL_CLIENT_ID_FILE="${16}.aws_cognito_pool_client_id"
COGNITO_USER_CREATE_FILE="${16}.aws_cognito_create_users"
COGNITO_USER_LIST_FILE="${16}.aws_cognito_users"
COGNITO_IAM_ROLE_ARN="${16}.iam_role_arn"

# create the iam role to be used
# remove-role-from-instance-profile
# detach-role-policy
# delete-role-policy
aws iam --region "${15}" list-roles --output text --query 'Roles[?RoleName==`'"${22}"'`].Arn' > "${16}.rolename_check"
if [ -z `cat "${16}.rolename_check"` ]
then
    echo "Role ${22}" does not exist
else
    echo "Deleting Role ${22}"
    aws iam delete-role --role-name "${22}"
fi

aws iam --region "${15}" create-role --role-name "${22}" --description "IAM Role for OnCloudtime Users" --assume-role-policy-document file://${script_full_path}/../../config/policies/oncloudtime-iam-role-trust-policy.json --output text --query 'Role.Arn' > ${COGNITO_IAM_ROLE_ARN}

# delet all existing pools with the same name
aws cognito-idp --region "${15}" list-user-pools --max-results 20 --output text --query 'UserPools[?Name==`'"${21}"'`].Id' > "${16}.user_pool_name_check"
existing_user_pools_ids=`cat "${16}.user_pool_name_check"`
if [[ -z "${existing_user_pools_ids}" ]]
then
    echo "User Pool named ${21}" does not exist
else
    # delete all the user pools with the matching name
    for user_pool_id_for_deletion in ${existing_user_pools_ids}
    do
      echo "Deleting User Pool with name ${21} and id ${user_pool_id_for_deletion}"
      aws cognito-idp --region "${15}" delete-user-pool --user-pool-id "${user_pool_id_for_deletion}"
    done
fi
# create the cognito user pool
aws cognito-idp --region "${15}" create-user-pool --pool-name "${21}" --username-attributes "email" --email-verification-message "Please click the link below to verify your email address {####}" --email-verification-subject "OnCloudTime Account Verification Link" --schema 'Name=accountid,AttributeDataType=Number,NumberAttributeConstraints={MinValue=1,MaxValue=4000000},Mutable=false' 'Name=uuid,AttributeDataType=String,Mutable=false,StringAttributeConstraints={MinLength=38,MaxLength=38}'  --admin-create-user-config "AllowAdminCreateUserOnly=false,UnusedAccountValidityDays=90" --output text --query 'UserPool.Id' > "$COGNITO_POOL_ID_FILE"

cognito_pool_id=`cat "$COGNITO_POOL_ID_FILE"`
echo "The cognito pool id is $cognito_pool_id"

cognito_group_iam_role_arn=`cat ${COGNITO_IAM_ROLE_ARN}`
# create a group to which all users will belong to and to which the IAM role will be attached
aws cognito-idp --region "${15}" create-group --user-pool-id ${cognito_pool_id} --group-name ${20} --description "Group for Oncloudtime User Pool" --role-arn ${cognito_group_iam_role_arn}

# create an app client
aws cognito-idp --region "${15}" create-user-pool-client --user-pool-id "$cognito_pool_id"  --client-name "${23}" --refresh-token-validity 300 --no-generate-secret --explicit-auth-flows "ADMIN_NO_SRP_AUTH" "USER_PASSWORD_AUTH" --supported-identity-providers "COGNITO" --read-attributes "email" "custom:uuid" "custom:accountid" --write-attributes "email" "custom:uuid" "custom:accountid" --output text --query 'UserPoolClient.ClientId' > "$COGNITO_POOL_CLIENT_ID_FILE"

cognito_pool_client_id=`cat "$COGNITO_POOL_CLIENT_ID_FILE"`

echo "The cognito pool client id is $cognito_pool_client_id"

# update the install.yaml with the values of the cognito pool configurations
tmp=$(mktemp)
yq -j '.parameters.cognito_pool_id = "'${cognito_pool_id}'"' "$INSTALL_YAML_FILE" > "$tmp" && mv "$tmp" "$INSTALL_YAML_FILE"
yq -j '.parameters.cognito_pool_client_id = "'${cognito_pool_client_id}'"' "$INSTALL_YAML_FILE" > "$tmp" && mv "$tmp" "$INSTALL_YAML_FILE"

# file gets converted to JSON so convert it to back to
cat "$INSTALL_YAML_FILE" | yq -y . > "$INSTALL_YAML_FILE".tmp
cat "${INSTALL_YAML_FILE}".tmp > "$INSTALL_YAML_FILE"
rm -f "$INSTALL_YAML_FILE".tmp

# roles, users and user_role_assignments
mysql -h $4 --user=$1 --password=$2 --skip-column-names -e "SELECT credential_email FROM app_user" $3 > "$COGNITO_USER_LIST_FILE"
mysql -h $4 --user=$1 --password=$2 --skip-column-names -e "SELECT CONCAT('--username ', credential_email, ' --user-attributes=Name=\"custom:uuid\",Value=\"' , REPLACE(uuid, '\n', ''), '\",Name="custom:accountid",Value=\"', account_id, '\",Name=\"email\",Value=\"', credential_email, '\"') FROM app_user" $3 > "$COGNITO_USER_CREATE_FILE"

echo "Adding application users to ${cognito_pool_id}"
while IFS= read -r user_details
do
  aws cognito-idp --region "${15}" sign-up --client-id "${cognito_pool_client_id}" ${user_details} --password ${24}
done < "${COGNITO_USER_CREATE_FILE}"

echo "Setting passwords and confirming signup for application users in ${cognito_pool_id}"
while IFS= read -r username
do
    echo "confirming signup for  ${username}"
  aws cognito-idp --region "${15}" admin-confirm-sign-up --user-pool-id "${cognito_pool_id}" --username ${username}

  # add the user to a group
  # get the username which is a uuid that is used in the next command
  cognito_username=`aws cognito-idp --region "${15}" admin-get-user --user-pool-id "${cognito_pool_id}" --username ${username} --output text --query 'Username'`
  aws cognito-idp --region "${15}" admin-add-user-to-group --user-pool-id "${cognito_pool_id}" --username ${cognito_username} --group-name ${20}
done < "${COGNITO_USER_LIST_FILE}"

# only write the configuration to a pre-defined secret if definition is found and all other settings are completed
# if [[ -f "$script_full_path/../app_config_url.cnf" ]]
#     echo "Secrets config file exists and will be read"
#    then
#       if [[ -s "$script_full_path/../app_config_url.cnf" ]]
#       then
#         echo "Secrets config file exists and is not empty"
#         config_url=`cat "$script_full_path/../app_config_url.cnf"`
#         echo "The secret url is ${config_url}"
#         # Copy the install.yaml file contents into the secret only if it has been specified
#         if [ ! -z "${config_url}" ]
#          then
#           aws secretsmanager --region "${15}" put-secret-value --secret-id "${config_url}" --secret-string file://"$script_full_path/../../config/install/install.yaml"
#           echo "Application configuration written to secret"
#         fi
#     fi
# fi
