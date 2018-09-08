#!/usr/bin/env bash

# Shutdown the laravel app
php artisan down

# Update repository files
#git pull origin master

# Install new composer packages
#composer install --no-interaction --prefer-dist --optimize-autoloader

# Sync database changes
#php artisan migrate --force

# Cache boost configuration and routes
#php artisan cache:clear
#php artisan config:cache
#php artisan route:cache

#php public/opcache_reset.php

#php artisan queue:restart

# Rise from the ashes
php artisan up

echo 'Deploy finished.'
