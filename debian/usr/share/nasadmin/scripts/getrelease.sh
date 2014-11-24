#!/bin/bash
lsb_release -d|sed 's/Description://g'|xargs
echo "" 
lsblk|grep disk|awk '{print $1}'
echo ""
blkid |grep vda
