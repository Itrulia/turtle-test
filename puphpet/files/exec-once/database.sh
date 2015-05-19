#!/usr/bin/env bash
cd /var/www/battleborn

mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS battleborn"
php artisan migrate
php artisan db:seed
# Set up the testing environment
mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS battleborn_test"
php artisan migrate --env=testing
