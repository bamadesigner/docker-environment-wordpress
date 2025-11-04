#!/bin/bash

docker compose exec database sh \
    -lc 'mariadb-dump -u root -p"$MARIADB_ROOT_PASSWORD" "$MARIADB_DATABASE"' > backup.sql