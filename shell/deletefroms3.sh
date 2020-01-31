#!/bin/bash

set -e

script_full_path=$(dirname "$0")
source "$script_full_path/".aws_config
# $1 - s3 region
# $2 - path to directory to be removed  

echo "$1" "$2"
  aws s3 rm --recursive --region "$1" "$2"