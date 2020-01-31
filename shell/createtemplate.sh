#!/bin/bash

# set error for failed command
set -e
set -x

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - rdbms_user
# $2 - rdbms_password
# $3- rdbms_dbname
# $4 - rdbms_host
# $5 - name
# $6 - format
# $7 - table name
# $8 - delimiter
# $9 - samplerow
# ${10} - rules
# ${11} - athena_database
# ${12} - athena_output
# ${13} - uuid
# ${14} - s3 region
# ${15} - absolute path to log file
# ${16} - path to s3 folder to upload log file
# ${17} - s3 presign duration
# ${18} - username
# ${19} - s3 bucket
# ${20} = the column definitions for creating an athena table
# ${21) - type whether user or core
# ${22) - accountid
# ${23} - account name
# ${24} - log file name
# ${25} - userid
# ${26} - simulationid shown as model on the screen

echo "$1"
echo "$2"
echo "$3"
echo "$4"
echo "$5"
echo "$6"
echo "$7"
echo "$8"
echo "$9"
echo "${10}"
echo "${11}"
echo "${12}"
echo "${13}"
echo "${14}"
echo "${15}"
echo "${16}"
echo "${17}"
echo "${18}"
echo "${19}"
echo "${20}"
echo "${21}"
echo "${22}"
echo "account name - ${23}"
echo "userid - ${25}"

# Variables for both text (always created) and format (the format selected on the screen) to handle transformations with teach

query_input_folder_key_user_text="data/${23}/home/${18}/intake/template/$5/Text/"
query_input_folder_key_user_format="data/${23}/home/${18}/intake/template/$5/$6/"
query_input_folder_key_shared_text="data/${23}/shared/template/$5/Text/"
query_input_folder_key_shared_format="data/${23}/shared/template/$5/$6/"
query_input_folder_user_text="s3://${19}/$query_input_folder_key_user_text"
query_input_folder_user_format="s3://${19}/$query_input_folder_key_user_format"
query_input_folder_shared_text="s3://${19}/$query_input_folder_key_shared_text"
query_input_folder_shared_format="s3://${19}/$query_input_folder_key_shared_format"
query_output_folder_user_text="s3://${19}/data/${23}/home/${18}/templateprocessing/$5/Text/output/"
query_output_folder_user_format="s3://${19}/data/${23}/home/${18}/templateprocessing/$5/$6/output/"
query_output_folder_shared_text="s3://${19}/data/${23}/shared/templateprocessing/$5/Text/output/"
query_output_folder_shared_format="s3://${19}/data/${23}/shared/templateprocessing/$5/$6/output/"

echo "uuid " ${13}

simulationid="${26}"
# check if the simulationid is null
if [ -z "$simulationid" ];
then
    simulationid="NULL"
fi

# there are different folders for user and core templates
template_table_name="$7"
if [ "Core" = "${21}" ];
then
    template_input_folder="$query_input_folder_key_shared_format"
    template_output_folder="$query_output_folder_shared_format"
    if [ "Text" = "$6" ];
    then
        text_user_table_name="$7_u"
        text_shared_user_table_name="$7"
    else
        text_user_table_name="$7_u_text"
        text_shared_user_table_name="$7_text"
    fi

else
    template_input_folder="$query_input_folder_key_user_format"
    template_output_folder="$query_output_folder_user_format"
    template_table_name="$7_u"
    if [ "Text" = "$6" ];
    then
        text_user_table_name="$7_u"
    else
        text_user_table_name="$7_text"

    fi
fi

mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
INSERT INTO template (\`name\`, \`format\`, \`tablename\`, \`delimiter\`, \`samplerow\`, \`rules\`, \`uuid\`, \`isactive\`, \`datecreated\`, \`bucketinput\`, \`bucketoutput\`, \`type\`, \`accountid\`,\`createdby\`, \`simulationid\`) VALUES ("$5", "$6", "$template_table_name", "$8", '$9', '${10}', "${13}", 1, NOW(), "$template_input_folder","$template_output_folder", "${21}", ${22}, ${25}, $simulationid);
EOF

# create the input user directory on s3
aws s3api put-object --region "${14}" --bucket "${19}" --key "$query_input_folder_key_user_text"

# delete the text table to be able to recreate it
source $script_full_path"/"deleteathenatable.sh "${11}" "${14}" "$text_user_table_name" "$query_output_folder_user_text" "${15}.delete.text"
# create the athena table for the user using text - the tablename has a suffix _u
query_user="aws --region ${14} athena start-query-execution --query-string \"create external table $text_user_table_name (${20})  ROW FORMAT DELIMITED FIELDS TERMINATED BY '$8' LOCATION '$query_input_folder_user_text';\" --result-configuration OutputLocation='$query_output_folder_user_text' --query-execution-context Database=${11}"

echo $query_user
query_id_user="$(eval $query_user)"

echo "The format is $6"
# xreate the user format tables
if [ "Parquet" = "$6" ];
then
    # not text so carry out the transformation
    echo "Creating a table with format $6"
    query_parquet_table="aws --region ${14} athena start-query-execution --query-string \"create external table $7_u (${20}) STORED AS PARQUET LOCATION '$query_input_folder_user_format' TBLPROPERTIES('has_encrypted_data'='false','parquet.compression'='SNAPPY');\" --result-configuration OutputLocation='$query_output_folder_user_format' --query-execution-context Database=${11}"
    parquet_table_id="$(eval $query_parquet_table)"
    echo "The parquet table query id is $parquet_table_id"
fi

if [ "ORC" = "$6" ];
then
    # not text so carry out the transformation
    echo "Creating a table with format  $6"
    query_orc_table="aws --region ${14} athena start-query-execution --query-string \"create external table $7_u (${20}) STORED AS ORC LOCATION '$query_input_folder_user_format' TBLPROPERTIES('has_encrypted_data'='false','orc.compression'='ZLIB');\" --result-configuration OutputLocation='$query_output_folder_user_format' --query-execution-context Database=${11}"
    orc_table_id="$(eval $query_orc_table)"
    echo "The orc table query id is $orc_table_id"

fi

if [ "JSON" = "$6" ];
then
    # not text so carry out the transformation
    echo "Creating a table with format  $6"
    query_json_table="aws --region ${14} athena start-query-execution --query-string \"create external table $7_u (${20}) ROW FORMAT  serde 'org.apache.hive.hcatalog.data.JsonSerDe' LOCATION '$query_input_folder_user_format' TBLPROPERTIES('has_encrypted_data'='false');\" --result-configuration OutputLocation='$query_output_folder_user_format' --query-execution-context Database=${11}"
    json_table_id="$(eval $query_json_table)"
    echo "The json table query id is $json_table_id"

fi

# create the query for the athena table for the user using the selected format
query_uuid_user=$(uuidgen | tr "[:upper:]" "[:lower:]")
query_user_path="${19}/data/${23}/home/${18}/query/"

source $script_full_path"/"createquery.sh "$1" "$2" "$3" "$4" "$5" "Athena" "$5" "SELECT * FROM $7_u LIMIT 100" "$query_uuid_user" "${14}" "${19}" "${17}" "${18}" "User" "${22}" "${15}" "$query_user_path" "$query_uuid_user" ${25}

# only create shared templates for those created by administrators
if [ "Core" = "${21}" ];
then
    # create the shared user directory on s3
    aws s3api put-object --region "${14}" --bucket "${19}" --key "$query_input_folder_key_shared_text"

    # create the shared athena table - the tablename
    query_shared="aws --region ${14} athena start-query-execution --query-string \"create external table $text_shared_user_table_name (${20})  ROW FORMAT DELIMITED FIELDS TERMINATED BY '$8' LOCATION '$query_input_folder_shared_text';\" --result-configuration OutputLocation='$query_output_folder_shared_text' --query-execution-context Database=${11}"

    echo "Shared ".$query_shared
    query_id_shared="$(eval $query_shared)"

    if ['text' != $6]
    then
        # not text so carry out the transformation
        echo "Transforming core table to to $6"
    fi

    # create the user core tables
    if [ "Parquet" = "$6" ];
    then
        # not text so carry out the transformation
        echo "Creating a table with format $6"
        query_parquet_table="aws --region ${14} athena start-query-execution --query-string \"create external table $7 (${20}) STORED AS PARQUET LOCATION '$query_input_folder_shared_format' TBLPROPERTIES('has_encrypted_data'='false','parquet.compression'='SNAPPY');\" --result-configuration OutputLocation='$query_output_folder_shared_format' --query-execution-context Database=${11}"
        parquet_table_id="$(eval $query_parquet_table)"
        echo "The parquet table query id is $parquet_table_id"
    fi

    if [ "ORC" = "$6" ];
    then
        # not text so carry out the transformation
        echo "Creating a table with format  $6"
        query_orc_table="aws --region ${14} athena start-query-execution --query-string \"create external table $7 (${20}) STORED AS ORC LOCATION '$query_input_folder_shared_format' TBLPROPERTIES('has_encrypted_data'='false','orc.compression'='ZLIB');\" --result-configuration OutputLocation='$query_output_folder_shared_format' --query-execution-context Database=${11}"
        orc_table_id="$(eval $query_orc_table)"
        echo "The orc table query id is $orc_table_id"

    fi

    if [ "JSON" = "$6" ];
    then
        # not text so carry out the transformation
        echo "Creating a table with format  $6"
        query_json_table="aws --region ${14} athena start-query-execution --query-string \"create external table $7 (${20}) ROW FORMAT  serde 'org.apache.hive.hcatalog.data.JsonSerDe' LOCATION '$query_input_folder_shared_format' TBLPROPERTIES('has_encrypted_data'='false');\" --result-configuration OutputLocation='$query_output_folder_shared_format' --query-execution-context Database=${11}"
        json_table_id="$(eval $query_json_table)"
        echo "The json table query id is $json_table_id"
    fi

    # create the query for the shared athena table
    query_uuid_shared=$(uuidgen | tr "[:upper:]" "[:lower:]")
    query_shared_path="${19}/data/${23}/shared/query/"
    source $script_full_path"/"createquery.sh "$1" "$2" "$3" "$4" "$5" "Athena" "$5" "SELECT * FROM $7 LIMIT 100" "$query_uuid_shared" "${14}" "${19}"  "${17}" "${18}" "Core" "${22}" "${15}" "$query_shared_path" "$query_uuid_shared" ${25}

fi

echo 0