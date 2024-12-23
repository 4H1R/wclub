#! /bin/bash

TIMEOUT=45
CADDY_PATH="/etc/caddy/Caddyfile"

if ! sudo -v; then
   echo "This script requires sudo privileges" 1>&2
   exit 1
fi

cd /var/www/wclub

echo "Running Fallback API"
docker compose -f docker-compose.prod.yml up -d api-fallback
sleep $TIMEOUT

echo "Replacing Caddy to use Fallback API"
sudo sed -i 's/localhost:8000/localhost:8001/g' "$CADDY_PATH"
sudo systemctl reload caddy

git pull
echo "Building New Updates..."
docker compose -f docker-compose.prod.yml build api
echo "Running API"
docker compose -f docker-compose.prod.yml up -d api
sleep $TIMEOUT

echo "Replacing Caddy to use API"
sudo sed -i 's/localhost:8001/localhost:8000/g' "$CADDY_PATH"
sudo systemctl reload caddy

echo "Stopping Fallback API"
docker compose -f docker-compose.prod.yml stop api-fallback
echo "Building Api Fallback..."
docker compose -f docker-compose.prod.yml build api-fallback