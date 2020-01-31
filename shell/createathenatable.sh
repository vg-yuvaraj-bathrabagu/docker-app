#!/usr/bin/env bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - type - the athena folder name
# $2 - table - the name of the table
# $3 - column definitions
# $4 - oldtable - empty for new tables, only has a value when deleting
# $5 - aws key
# $6 - aws secret
# $7 - S3 region
# $8 - s3 bucket
# $9 - athena_database
echo "$1 "
echo "$2"
echo "$3"
echo "$4"
echo "$5"
echo "$6"
echo "$7"
echo "$8"
echo "$9"

if [ -z $4 ]

    then
        # old table is empty so nothing to do
        echo 'Creating new table'
    else
        echo 'Dropping '$4
        # old table has a value so drop it
        aws athena --region $7 --debug start-query-execution --query-string "DROP TABLE IF EXISTS $4" --result-configuration "OutputLocation=s3://$8/$1athena-output/" --query-execution-context Database=$9
        echo $4' dropped '
fi

# note extra space before aws to ensure that it is not stored in the bash history
query_id=`aws athena --region $7 --debug start-query-execution --query-string "create external table $2 ($3) ROW FORMAT DELIMITED FIELDS TERMINATED BY ',' LOCATION 's3://$8/$1';" --result-configuration "OutputLocation=s3://$8/$1athena-output/" --query-execution-context Database=$9`
# the query id after execution
echo $query_id