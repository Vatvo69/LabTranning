#!/bin/bash

sudo crontab -l > cron
sudo echo "*/5 * * * * $(pwd)/sshmonitor.sh" >> cron
sudo crontab cron
sudo rm cron