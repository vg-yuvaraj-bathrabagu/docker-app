#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/../".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - salutation
# $6 - firstname
# $7 - lastname
# $8 - email address
# $9 - roles
# ${10} - account_id
# ${11} - account name
# ${12} - id
# ${13} - uuid
# ${14} = s3 region
# ${15} = bucket
# ${16} = log file name
# ${17} = SNS General topic
# ${18} = SNS account topic

# {126} - file upload loction


echo "id" $7
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE app_user SET \`salutation\` = "$5", \`firstname\` = "$6", \`lastname\`="$7", \`credential_email\` = "$8", \`initials\`="${19}", \`gender\`="${20}", \`jobtitle\`="${21}", \`blccode\`="${22}", \`jobcategory\`="${23}", \`department\`="${24}", \`joblocation\`="${25}", \`personalemailaddress\`="${26}", \`usertype\`="${27}", \`employeecategory\`="${28}", \`status\`="${29}", \`week_start\`="${30}", \`hourly_wage\`="${31}", \`photo\`="${32}", \`onvacation\`="${33}", \`mobilenumber\`="${34}", \`homephone\`="${35}", \`officeline1\`="${36}", \`faxnumber\`="${37}", \`address1\`="${38}", \`address2\`="${39}", \`stateorprovince\`="${40}", \`postalcode\`="${41}", \`city\`="${42}", \`country\`="${43}", \`companyname\`="${44}", \`companyaddress\`="${45}", \`ssn\`="${46}", \`ein\`="${47}", \`tsgbadgenumber\`="${48}", \`employeetype\`="${49}", \`birthdate\`=${50}, \`hiredate\`=${51}, \`employeestartdate\`=${52}, \`employeeenddate\`=${53}, \`releasedate\`=${54}, \`lastreviewdate\`=${55}, \`nextreviewdate\`=${56}, \`supervisorname\`="${57}", \`supervisoremail\`="${58}", \`supervisorofficeline\`="${59}", \`approver\`="${60}", \`approveremail\`="${61}", \`invoiceapprover\`="${62}", \`invoiceapproveremail\`="${63}", \`businessmeetingapprover\`="${64}", \`businessmeetingapproveremail\`="${65}", \`travelexpenseapprover\`="${66}", \`travelexpenseapproveremail\`="${67}", \`odcapprover\`="${68}", \`odcapproveremail\`="${69}", \`billsapprover\`="${70}", \`billsapproveremail\`="${71}", \`permissiontemplate\`="${72}", \`canviewemployeeresources\`="${73}", \`canviewpublicholidays\`="${74}", \`canviewpayrolldates\`="${75}", \`canviewtravelpolicy\`="${76}", \`canview401kinformation\`="${77}", \`canviewreferenceinformation\`="${78}", \`payrollfrequency\`="${79}", \`invoicecategory\`="${80}", \`maximumhoursperday\`=${81}, \`maximumhoursperweek\`=${82}, \`vacationdaysallowed\`="${83}", \`maximumvacationdays\`=${84}, \`personaldaysallowed\`="${85}", \`maximumpersonaldays\`="${86}", \`paidholidaysallowed\`="${87}", \`maximumpaidholidays\`=${88}, \`sickdaysallowed\`="${89}", \`maximumsickdays\`=${90}, \`saturdayworkallowed\`="${91}", \`sundayworkallowed\`="${92}", \`publicholidayworkallowed\`="${93}", \`employeebenefitsbillable\`="${94}", \`maximumsocialsecurity\`="${95}", \`ec1_firstname\`="${96}", \`ec1_lastname\`="${97}", \`ec1_streetaddress\`="${98}", \`ec1_city\`="${99}", \`ec1_state\`="${100}", \`ec1_zipcode\`="${101}", \`ec1_homephone\`="${102}", \`ec1_workphone\`="${103}", \`ec1_cellphone\`="${104}", \`ec1_relationship\`="${105}", \`ec2_firstname\`="${106}", \`ec2_lastname\`="${107}", \`ec2_streetaddress\`="${108}", \`ec2_city\`="${109}", \`ec2_state\`="${110}", \`ec2_zipcode\`="${111}", \`ec2_homephone\`="${112}", \`ec2_workphone\`="${113}", \`ec2_cellphone\`="${114}", \`ec2_relationship\`="${115}", \`ec3_firstname\`="${116}", \`ec3_lastname\`="${117}", \`ec3_streetaddress\`="${118}", \`ec3_city\`="${119}", \`ec3_state\`="${120}", \`ec3_zipcode\`="${121}", \`ec3_homephone\`="${122}", \`ec3_workphone\`="${123}", \`ec3_cellphone\`="${124}", \`ec3_relationship\`="${125}",  \`file_upload_location\`="${126}" WHERE \`id\` = ${12};

DELETE FROM user_role WHERE \`user_id\` = ${12};

SET @user_id = ${12};

$9

EOF
echo 0