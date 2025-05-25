#!/bin/sh

export $(grep -v '^#' .env | xargs)

DB_HOST=${DB_HOST:-mysql}

until nc -z "$DB_HOST" 3306; do
  echo "⏳ Waiting for MySQL at $DB_HOST:3306..."
  sleep 2
done

php artisan migrate --force

php-fpm
