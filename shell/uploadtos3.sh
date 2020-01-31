#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - s3 region
# $2 - file to be uploaded
# $3 - S3 folder location to copy the file which is s3://bucket/data/User_Nickname

# note extra space before aws to ensure that it is not stored in the bash history
# upload the file
  aws s3 --region $1 cp "$2" "$3"

