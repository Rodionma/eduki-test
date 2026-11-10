#!/bin/sh
set -e
cd /app

# The source is bind-mounted in development; install deps if vendor/ is missing.
[ -f vendor/autoload.php ] || composer install --no-interaction --prefer-dist

[ -f .env ] || cp .env.example .env
grep -q '^APP_KEY=base64:' .env || php artisan key:generate --force

# The db service is healthy before this container starts (depends_on: service_healthy).
php artisan migrate --force

exec "$@"
