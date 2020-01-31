#!/usr/bin/env bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - id
# $2 - uuid
# $3- search criteria
# $4 - aws key
# $5 - aws secret
# $6 - s3 bucket
# $7 - s3 region
# $8 - bucket input folder complete path
# $9 - bucket input folder (without s3://bucket)

echo "$1"
echo "$2"
echo "$3"
echo "$4"
echo "$5"
echo "$6"
echo "$7"
echo "$8"
echo  "$9"
echo "${10}"

# run the search and put the contents in a log file with prefix search and uuid of template
echo "Contents[?contains(Key, \`$3\`)]"
  aws s3api --region $7 list-objects --bucket $6 --prefix "${10}" --query "Contents[?contains(Key, \`$3\`)]" > ../var/log/search_$2