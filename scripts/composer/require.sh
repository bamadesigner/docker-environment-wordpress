#!/bin/sh

# Allow passing arguments to composer require
docker compose run --rm composer require "$@"