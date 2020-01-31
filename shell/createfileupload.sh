#!/bin/bash

set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
GLOBIGNORE="*"
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - filename
# $6 - absolute path to local file
# $7 - destination folder for text format
# $8 - templateid
# $9 - source
# ${10} - file size
# ${11} - uuid
# ${12} - user id
# ${13) - logged in username
# ${14} - account id
# ${15} - account name
# ${16} - s3 region
# ${17} - s3 bucket
# ${18} - s3 presign duration
# ${19} - template format
# ${20} - template table name
# ${21} - bucket output
# ${22} - athena database
# ${23} - template type
# ${24} - log file name
# ${25} - absolute path to log file name
# ${26} - destination folder for the template format
# ${27} - delimiter

echo "uuid ${11}"

echo $@

dt=$(date '+%d%m%Y%H%M%S');
echo "$dt"

temporary_text_tablename="${20}_text_$dt"
temporary_format_table_name="${20}_$dt"
template_table_name="${20}"
text_file_upload_path="$7" # all files are uploaded to a directory with the same name as the file name
text_table_directory="s3://${17}/$text_file_upload_path"
format_table_directory="s3://${17}/${26}"

# for core templates use the user table since that is where the files are uploaded 
if [ "Core" = "${23}" ];
then
    template_table_name="${template_table_name}_u"
fi

if [ "Text" != "${19}" ];
then
    # non text format so create a temporary text table for the transformation
    echo "Creating a temporary text table"
    aws --region ${16} athena start-query-execution --query-string "create TABLE $temporary_text_tablename WITH (format='TEXTFILE', field_delimiter = '${27}', external_location = '$text_table_directory') AS SELECT $GLOBIGNORE FROM $template_table_name;" --result-configuration OutputLocation="${21}" --query-execution-context Database="${22}" --output text > "${25}.out"

    query_execution_id=`cat "${25}.out" | awk {'print $1'}`

    START=`date "+%Y-%m-%d %H:%M"`
    count=0
    while true; do
        NOW=`date "+%Y-%m-%d %H:%M"`
          query_status=$(aws --region "${16}" athena get-query-execution --query-execution-id "$query_execution_id" | grep State |sed 's: ::g')
          query_status_exit_code=$?
          echo "The query execution exit code is $query_status_exit_code and $query_status"
        if [ $? = 0 ]; then
            # no errors have occured now check if the run has succeeded or failed
            case $query_status in
             *"SUCCEEDED"*)
                break;;
            *"FAILED"*)
                raise error "Query Execution Failed"
                exit 64
                ;;
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
fi

# upload the file to the text folder
    file_upload_result=`aws s3api --region "${16}" put-object --bucket "${17}" --body "$6" --key "$text_file_upload_path$5" --output text`
    echo $file_upload_result

# Log files
athena_tmp_text_log_file_absolute_path="${25}.athena"
athena_log_file_name="${24}.athena"

# convert the ffiles to the format specified by the template
case "${19}" in
    *"Parquet"*)
        echo "Converted file to Parquet"
        aws --region ${16} athena start-query-execution --query-string "create TABLE $temporary_format_table_name WITH (format='Parquet', parquet_compression = 'SNAPPY', external_location = '$format_table_directory') AS SELECT $GLOBIGNORE FROM $temporary_text_tablename;" --result-configuration OutputLocation="${21}" --query-execution-context Database="${22}" --output text > "${25}.out"

        query_execution_id=`cat "${25}.out" | awk {'print $1'}`

        START=`date "+%Y-%m-%d %H:%M"`
        count=0
        while true; do
            NOW=`date "+%Y-%m-%d %H:%M"`
              query_status=$(aws --region "${16}" athena get-query-execution --query-execution-id "$query_execution_id" | grep State |sed 's: ::g')
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

        # delete the temporary format table
        query_parquet_delete="aws --region ${16} athena start-query-execution --query-string \"DROP TABLE IF EXISTS $temporary_format_table_name;\" --result-configuration OutputLocation='${21}' --query-execution-context Database=${22}";
        echo "paraquet transform query $query_parquet_delete";
        query_id_parquet_delete="$(eval $query_parquet_delete)"

        # delete the temporary text table
        query_parquet_delete="aws --region ${16} athena start-query-execution --query-string \"DROP TABLE IF EXISTS $temporary_text_tablename;\" --result-configuration OutputLocation='${21}' --query-execution-context Database=${22}";
        echo "paraquet transform query $query_parquet_delete";
        query_id_parquet_delete="$(eval $query_parquet_delete)"
        ;;
     *"ORC"*)
        echo "Converting file to ORC"
        aws --region ${16} athena start-query-execution --query-string "create TABLE $temporary_format_table_name WITH (format='ORC', orc_compression = 'SNAPPY', external_location = '$format_table_directory') AS SELECT $GLOBIGNORE FROM $temporary_text_tablename;" --result-configuration OutputLocation="${21}" --query-execution-context Database="${22}" --output text > "${25}.out"

        query_execution_id=`cat "${25}.out" | awk {'print $1'}`

        START=`date "+%Y-%m-%d %H:%M"`
        count=0
        while true; do
            NOW=`date "+%Y-%m-%d %H:%M"`
              query_status=$(aws --region "${16}" athena get-query-execution --query-execution-id "$query_execution_id" | grep State |sed 's: ::g')
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

        # delete the temporary format table
        query_orc_delete="aws --region ${16} athena start-query-execution --query-string \"DROP TABLE IF EXISTS $temporary_format_table_name;\" --result-configuration OutputLocation='${21}' --query-execution-context Database=${22}";
        echo "orc transform query $query_orc_delete";
        query_id_orc_delete="$(eval $query_orc_delete)"

        # delete the temporary text table
        query_orc_delete="aws --region ${16} athena start-query-execution --query-string \"DROP TABLE IF EXISTS $temporary_text_tablename;\" --result-configuration OutputLocation='${21}' --query-execution-context Database=${22}";
        echo "orc transform query $query_orc_delete";
        query_id_orc_delete="$(eval $query_orc_delete)"
        ;;
     *"JSON"*)
        echo "Converting file to JSON"
        aws --region ${16} athena start-query-execution --query-string "create TABLE $temporary_format_table_name WITH (format='JSON', external_location = '$format_table_directory') AS SELECT $GLOBIGNORE FROM $temporary_text_tablename;" --result-configuration OutputLocation="${21}" --query-execution-context Database="${22}" --output text > "${25}.out"

        query_execution_id=`cat "${25}.out" | awk {'print $1'}`

        START=`date "+%Y-%m-%d %H:%M"`
        count=0
        while true; do
            NOW=`date "+%Y-%m-%d %H:%M"`
              query_status=$(aws --region "${16}" athena get-query-execution --query-execution-id "$query_execution_id" | grep State |sed 's: ::g')
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

        # delete the temporary format table
        query_json_delete="aws --region ${16} athena start-query-execution --query-string \"DROP TABLE IF EXISTS $temporary_format_table_name;\" --result-configuration OutputLocation='${21}' --query-execution-context Database=${22}";
        echo "orc transform query $query_json_delete";
        query_id_orc_delete="$(eval $query_json_delete)"

        # delete the temporary text table
        query_orc_delete="aws --region ${16} athena start-query-execution --query-string \"DROP TABLE IF EXISTS $temporary_text_tablename;\" --result-configuration OutputLocation='${21}' --query-execution-context Database=${22}";
        echo "JSON transform query $query_json_delete";
        query_id_json_delete="$(eval $query_json_delete)"
esac

mysql -v -v -h $1 --user=$2 --password=$3 $4 <<EOF
INSERT INTO fileupload (\`name\`, \`folder\`, \`templateid\`, \`source\`, \`size\`, \`uuid\`,\`status\`, \`color\`, \`date\`, \`uploadedby\`, \`statusresult\`, \`accountid\`) VALUES ("$5", "${26}", "$8", "$9", "${10}", "${11}", "Pending", "orange", NOW(), ${12}, $file_upload_result, ${14});
EOF

# delete the locally file to free up space on the container
rm -fr "$6"

echo 0