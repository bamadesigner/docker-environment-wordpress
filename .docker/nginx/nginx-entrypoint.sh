#!/bin/sh
set -e

echo "🌐 Using domain: ${DOMAIN:-wordpress.local}"

# Substitute environment vars into config template
envsubst '${DOMAIN}' < /etc/nginx/conf.d/wordpress.conf.template > /etc/nginx/conf.d/default.conf

# Start Nginx
exec nginx -g 'daemon off;'