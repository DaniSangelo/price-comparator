#!/bin/sh
set -e

echo "==> Running Laravel optimize:clear..."
php artisan optimize:clear || true

echo "==> Starting PHP server..."
exec php -S 0.0.0.0:80 -t public 2>&1
