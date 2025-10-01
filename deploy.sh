#!/bin/bash

# Exit on any error
set -e

echo "Starting deployment for RentalPS..."

# Install PHP dependencies
echo "Installing PHP dependencies..."
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --quiet
rm composer-setup.php
php composer.phar install --no-dev --optimize-autoloader

# Install Node.js dependencies
echo "Installing Node.js dependencies..."
npm install

# Build assets
echo "Building assets..."
npm run build

# Set up Laravel
echo "Setting up Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "RentalPS deployment completed successfully!"