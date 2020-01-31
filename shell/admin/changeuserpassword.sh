#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - id
# $6 - uuid
# $7 - old password
# $8 - new password
# $9 - email address
# $10- region
# $11 - user pool id
# $12 - client id


access_token=`aws cognito-idp initiate-auth --client-id "${12}" --auth-flow USER_PASSWORD_AUTH --auth-parameters USERNAME="$9",PASSWORD="\"${7}\"" --output text --query 'AuthenticationResult.AccessToken'`
echo ${access_token}
aws cognito-idp change-password --previous-password "$7" --proposed-password "$8" --access-token "${access_token}"
echo 0