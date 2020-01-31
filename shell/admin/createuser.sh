#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - salutation
# $6 - firstname
# $7 - lastname
# $8 - email
# $9 - roles
# ${10} - account_id
# ${11} - account name
# ${12} - username
# ${13} - password
# ${14} - uuid
# ${15} - s3 region
# ${16} - s3 bucket
# ${17} - log file
# ${18} - Sns general topic
# ${19} - Sns account topic
# ${20} - Sns user topic
# ${128} - file upload location
# ${129} - cognito pool id
# ${130} - cognito pool client id
# ${131} - the user pool group to which users are to be added

echo "uuid" ${10}

sns_user_topic=`aws --region "${15}" sns create-topic --name "${20}" --output text`
echo "The user topic arn is $sns_user_topic"

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
START TRANSACTION;

INSERT INTO app_user (\`salutation\`, \`firstname\`, \`lastname\`, \`credential_email\`, \`account_id\`, \`credential_nickname\`, \`credential_password\`,  \`uuid\`, \`snstopic\`, \`initials\` , \`gender\` , \`jobtitle\` , \`blccode\` , \`jobcategory\` , \`department\` , \`joblocation\` , \`personalemailaddress\` , \`usertype\` , \`employeecategory\` , \`status\` , \`week_start\` , \`hourly_wage\` , \`photo\` , \`onvacation\` , \`mobilenumber\` , \`homephone\` , \`officeline1\` , \`faxnumber\` , \`address1\` , \`address2\` , \`stateorprovince\` , \`postalcode\` , \`city\` , \`country\` , \`companyname\` , \`companyaddress\` , \`ssn\` , \`ein\` , \`tsgbadgenumber\` , \`employeetype\` , \`birthdate\` , \`hiredate\` , \`employeestartdate\` , \`employeeenddate\` , \`releasedate\` , \`lastreviewdate\` , \`nextreviewdate\` , \`supervisorname\` , \`supervisoremail\` , \`supervisorofficeline\` , \`approver\` , \`approveremail\` , \`invoiceapprover\` , \`invoiceapproveremail\` , \`businessmeetingapprover\` , \`businessmeetingapproveremail\` , \`travelexpenseapprover\` , \`travelexpenseapproveremail\` , \`odcapprover\` , \`odcapproveremail\` , \`billsapprover\` , \`billsapproveremail\` , \`permissiontemplate\` , \`canviewemployeeresources\` , \`canviewpublicholidays\` , \`canviewpayrolldates\` , \`canviewtravelpolicy\` , \`canview401kinformation\` , \`canviewreferenceinformation\` , \`payrollfrequency\` , \`invoicecategory\` , \`maximumhoursperday\` , \`maximumhoursperweek\` , \`vacationdaysallowed\` , \`maximumvacationdays\` , \`personaldaysallowed\` , \`maximumpersonaldays\` , \`paidholidaysallowed\` , \`maximumpaidholidays\` , \`sickdaysallowed\` , \`maximumsickdays\` , \`saturdayworkallowed\` , \`sundayworkallowed\` , \`publicholidayworkallowed\` , \`employeebenefitsbillable\` , \`maximumsocialsecurity\` , \`ec1_firstname\` , \`ec1_lastname\` , \`ec1_streetaddress\` , \`ec1_city\` , \`ec1_state\` , \`ec1_zipcode\` , \`ec1_homephone\` , \`ec1_workphone\` , \`ec1_cellphone\` , \`ec1_relationship\` , \`ec2_firstname\` , \`ec2_lastname\` , \`ec2_streetaddress\` , \`ec2_city\` , \`ec2_state\` , \`ec2_zipcode\` , \`ec2_homephone\` , \`ec2_workphone\` , \`ec2_cellphone\` , \`ec2_relationship\` , \`ec3_firstname\` , \`ec3_lastname\` , \`ec3_streetaddress\` , \`ec3_city\` , \`ec3_state\` , \`ec3_zipcode\` , \`ec3_homephone\` , \`ec3_workphone\` , \`ec3_cellphone\` , \`ec3_relationship\`, \`datecreated\`, \`file_upload_location\` ) VALUES ("$5", "$6", "$7","$8","${10}","${12}",PASSWORD("${13}"),"${14}", "$sns_user_topic","${21}" , "${22}" , "${23}" , "${24}" , "${25}" , "${26}" , "${27}" , "${28}" , "${29}" , "${30}" , "${31}" , "${32}" , ${33} , "${34}" , "${35}" , "${36}" , "${37}" , "${38}" , "${39}" , "${40}" , "${41}" , "${42}" , "${43}" , "${44}" , "${45}" , "${46}" , "${47}" , "${48}" , "${49}" , "${50}" , "${51}" , ${52} , ${53} , ${54} , ${55} , ${56} , ${57} , ${58} , "${59}" , "${60}" , "${61}" , "${62}" , "${63}" , "${64}" , "${65}" , "${66}" , "${67}" , "${68}" , "${69}" , "${70}" , "${71}" , "${72}" , "${73}" , "${74}" , "${75}" , "${76}" , "${77}" , "${78}" , "${79}" , "${80}" , "${81}" , "${82}" , ${83} , ${84} , "${85}" , ${86} , "${87}" , ${88} , "${89}" , ${90} , "${91}" , ${92} , "${93}" , "${94}" , "${95}" , "${96}" , ${97} , "${98}" , "${99}" , "${100}" , "${101}" , "${102}" , "${103}" , "${104}" , "${105}" , "${106}" , "${107}" , "${108}" , "${109}" , "${110}" , "${111}" , "${112}" , "${113}" , "${114}" , "${115}" , "${116}" , "${117}" , "${118}" , "${119}" , "${120}" , "${121}" , "${122}" , "${123}" , "${124}" , "${125}" , "${126}" , "${127}", NOW(), "${128}");

SET @user_id = LAST_INSERT_ID();

$9

-- assign the inbuilt projects
INSERT INTO \`project_assignment\` (\`userid\`, \`projectid\`, \`startdate\`, \`uuid\`, \`accountid\`) SELECT u.id, p.id, u.datecreated, UUID(), p.accountid FROM app_user u, project p WHERE u.id =  @user_id AND u.account_id = p.accountid;

COMMIT;
EOF

# add the admin user account to cognito
aws cognito-idp --region "${15}" sign-up --client-id "${130}" --username "$8" --user-attributes=Name="custom:uuid",Value="${14}",Name=custom:accountid,Value="${10}",Name="email",Value="$8" --password "${13}"
aws cognito-idp admin-confirm-sign-up --user-pool-id "${129}" --username "$8"
# confirm the user account signup so that they can login
# add the user to the oncloudtime group
cognito_username=`aws cognito-idp --region "${15}" admin-get-user --user-pool-id "${129}" --username "$8" --output text --query 'Username'`
aws cognito-idp --region "${15}" admin-add-user-to-group --user-pool-id "${129}" --username "${cognito_username}" --group-name "${131}"
# add the inline policy for the user to enable their access to an S3 bucket


# create the user folder on s3 within the account forlder
aws s3api put-object --region "${15}" --bucket ${16} --key "data/${11}/home/${12}/"

# subscribe the user to all the sns topics: app-general, account and user
aws --region "${15}" sns subscribe --topic-arn "${18}" --protocol email --notification-endpoint "$8"
aws --region "${15}" sns subscribe --topic-arn "${18}" --protocol email --notification-endpoint "$8"
aws --region "${15}" sns subscribe --topic-arn "$sns_user_topic" --protocol email --notification-endpoint "$8"

echo 0