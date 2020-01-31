#!/bin/bash

set -e

echo "uuid" ${11}
mysql -h $1 --user=$2 --password=$3 $4 -v -v <<EOF
UPDATE conversion SET \`name\` = "$5", \`description\` = "$6", \`type\` = "$7", \`url\` = "$8", \`parameters\` = "$9" WHERE \`id\` = ${10};
EOF
echo 0