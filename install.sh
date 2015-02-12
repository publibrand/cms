#!/bin/sh
echo -e "-------------- Installing Dependencies  --------------\n"
composer install
npm install
bower install
echo -e "\n"

echo -e "------------------ Create Database  ------------------\n"
echo "Resetting migrations:"
php artisan migrate:reset
echo "Clearing cache:"
php artisan cache:clear
echo "Running migrations:"
php artisan migrate --package=cartalyst/sentry --env=local
php artisan migrate --env=local 
echo "Seeding database:"
php artisan db:seed --env=local

echo -e "--------------- Installation Complete  ---------------\n"