#!/bin/bash

set -e

echo "uuid" ${10}
mysql -h $1 --user=$2 --password=$3 $4 <<EOF
INSERT INTO conversion (\`name\`, \`description\`, \`type\`, \`url\`, \`parameters\`, \`uuid\`,\`datecreated\`) VALUES ("$5", "$6", "$7", "$8", "$9", "${10}", NOW());
EOF
echo 0