#!/bin/sh
set -e

if [ -f composer.json ]; then
    composer --ignore-platform-reqs install
fi

exec docker-php-entrypoint "$@"