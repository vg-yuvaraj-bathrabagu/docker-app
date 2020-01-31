#!/usr/bin/env bash

set -x
script_full_path=$(dirname "$0")

# This file helps run post-deployment actions
# Clear the cache to take the new files especially models
echo "Clearing the app cache"
rm -fr "$script_full_path"/var/cache/prod/*
rm -fr "$script_full_path"/var/data/*

# set file permissions
echo "Making install config directory, aws credential file and var directory writeable"
# chown -R nginx:nginx "$script_full_path"
chmod -R 777 "$script_full_path"/config/install
chmod 777 "$script_full_path"/shell/.aws_config
chmod -R 777 "$script_full_path"/var
echo "Setting execute permissions for scripts in the shell directory"
chmod -R +x "$script_full_path"/shell/*