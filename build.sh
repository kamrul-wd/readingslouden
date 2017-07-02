#!/bin/sh

# Run some general commands so we're up-to-date
composer self-update
composer install --no-interaction --optimize-autoloader

# Setup db
touch database/testing.sqlite
echo "" > database/testing.sqlite
php artisan migrate --database=testing --env=testing

# Start tests
vendor/bin/phpmd app/ text phpmd.xml
vendor/bin/phpcbf --standard=psr2 app/
vendor/bin/phpcs --standard=psr2 --colors app/
vendor/bin/phpunit
