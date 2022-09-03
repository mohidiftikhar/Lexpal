#!/bin/bash
echo -n "Start "
php /var/www/html/artisan run:split_csv
echo -n "CSV SPLIT DONE "
php /var/www/html/artisan run:import_csv_table
echo -n "CSV IMPORT DONE "
echo -n "CSV DELETED COMMAND"
php /var/www/html/artisan run:csv-delete
