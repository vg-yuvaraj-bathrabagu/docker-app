#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - tablename
# $2- query string
# $3 - output
# $4- region
# $5 - s3 bucket
# $6 - s3 presign duration
# $7 - logged in username
# $8 - account id
# $9 - log file name
# ${10} - athena database
# ${11} - athena output location
# ${12} - log file absolute path

echo $@
echo "# Run Analysis"
# clear out the previous execution data

# the variable to hold the results of the execution
athena_log_file_https_url=""
athena_query_result=''

echo "S3 upload url"$s3_upload_folder

athena_log_file_absolute_path="${12}.athena"
athena_log_file_name="$9.athena"
athena_log_file_presign="${12}.presign_url"
# run the athena query
aws athena --region "$4" start-query-execution  --query-string "$2" --result-configuration "OutputLocation=$3" --query-execution-context Database="${10}" --output text > "${12}.out"
query_execution_id=`cat ${12}".out" | awk {'print $1'}`

START=`date "+%Y-%m-%d %H:%M"`
count=0
while true; do
    NOW=`date "+%Y-%m-%d %H:%M"`
      query_status=$(aws --region "$4" athena get-query-execution --query-execution-id "$query_execution_id" | grep State |sed 's: ::g')
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
aws athena --region "$4" get-query-results --query-execution-id $query_execution_id --no-paginate --query "ResultSet" --output json > "$athena_log_file_absolute_path"

# Presign the url to the file
athena_log_file_https_url=`aws s3 presign "$3$query_execution_id.csv" --expires-in $6`
echo $athena_log_file_https_url > "$athena_log_file_presign"

# Copy the results CSV file from S3 locally
aws s3 cp "$3$query_execution_id.csv" "${12}.csv"
echo 0