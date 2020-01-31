#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - id
# $6 - title
# $7 - category
# $8 - s3 athena input directory
# $9 - description
# ${10} - querystring
# ${11} - athena_database name
# ${12} - athena_output location
# ${13} - uuid
# ${14} - s3 region
# ${15} - absolute path to log file
# ${16} - path to s3 folder to upload log file
# ${17} - s3 presign duration
# ${18} - s3 athena output directory
# ${19} - log file name

echo "# Run Query Results"
# clear out the previous execution data

mysql -h $1 --user=$2 --password=$3 $4 <<EOF
UPDATE customreport SET \`status\` = 'Running', \`color\`='orange', \`date\` = NOW(), \`statusresult\` = '',\`athenaoutput\` = '' WHERE \`id\` = $5;
EOF
echo "uuid" ${13}
echo "$1" "$2" "$3" "$4" "$5" "$6" "$7" "$8" "$9" "${10}" "${11}" "${12}"

# the variable to hold the results of the execution
athena_log_file_https_url=""
athena_query_result=''

# url to which log files will be copied
s3_upload_folder="s3://${16}${13}/"

echo "Path to log file ${15}"

echo "S3 upload url"$s3_upload_folder

if [ "Athena" = "$7" ];
then
    athena_log_file_absolute_path="${15}.athena"
    athena_log_file_name="${19}.athena"
    # run the athena query
    aws athena --region "${14}" start-query-execution  --query-string "${10}" --result-configuration "OutputLocation=${s3_upload_folder}" --query-execution-context Database="${11}" --output text > ${15}".out"
    query_execution_id=`cat ${15}".out" | awk {'print $1'}`

    START=`date "+%Y-%m-%d %H:%M"`
    count=0
    while true; do
        NOW=`date "+%Y-%m-%d %H:%M"`
          query_status=$(aws --region "${14}" athena get-query-execution --query-execution-id "$query_execution_id" | grep State |sed 's: ::g')
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
             raise error "Error occured while exeucitng the query - $query_execution_status"
        fi
        # aws --region "${14}" athena get-query-execution --query-execution-id "$query_execution_id"|grep State
        ((count=$count+1))
        echo "$count"
        echo "$START -- $NOW"
        sleep 1
    done
    END=`date "+%Y-%m-%d %H:%M"`
    echo "Athena output file $athena_log_file_absolute_path"
    aws athena --region "${14}" get-query-results --query-execution-id $query_execution_id --no-paginate --output json > "$athena_log_file_absolute_path"
    echo 'Query execution completed - Uploading file to s3'

    # Presign the url to the file
    athena_log_file_https_url=`aws s3 presign "$s3_upload_folder$query_execution_id.csv" --expires-in ${17}`

else

    # regular run commands
    ls -altr
fi

# copy the log file to S3
source $script_full_path"/"uploadtos3.sh ${14} ${15} "$s3_upload_folder${19}"

# Presign the url to the file
log_file_https_url=`aws s3 presign "$s3_upload_folder${19}" --expires-in ${17}`

# use the QUOTE Function for the athena result since it contains single and double quotes that need to be processed
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE customreport SET \`status\` = 'Completed', \`color\`='green', \`date\` = NOW(), \`statusresult\` = '$log_file_https_url', \`athenaoutput\` = '$athena_log_file_https_url' WHERE \`id\` = $5;
EOF

echo "log file url $log_file_https_url"
echo 0