#!/bin/bash

set -e

echo "uuid" $6
mysql -h $1 --user=$2 --password=$3 $4 <<EOF
DELETE FROM account WHERE \`id\` = $5;
EOF
echo 0