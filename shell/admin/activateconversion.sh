#!/bin/bash

set -e

echo "uuid" ${7}
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE conversion SET \`isactive\` = "$5" WHERE \`id\` = $6;
EOF
echo 0