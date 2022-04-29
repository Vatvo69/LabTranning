sudo echo "*/5 * * * * $(pwd)/monitor.sh" >> ./cron
sudo crontab ./cron
sudo rm ./cron