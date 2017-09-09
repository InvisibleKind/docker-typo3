#!/usr/bin/env bash

echo "Removing dangling images"
docker images -f dangling=true -q | xargs docker rmi

echo "Building Docker images"
cd /home/docker-typo3/docker/
docker-compose build

# Replace "down" with stop and "volume rm -f" of assets volumes, when a newer version of Docker is available in AMI
#docker-compose stop
echo "Stopping and removing Docker containers"
docker-compose down
echo "Removing assets volumes"
docker volume rm docker_typo3-tmp-assets-t3sys docker_typo3-tmp-assets-ext docker_typo3-tmp-assets-t3temp

echo "Bringing Docker containers back to live"
docker-compose up -d

echo "Apply DB schema changes"
docker-compose exec --user www-data -T typo3-php-fpm ./bin/typo3cms database:updateschema

echo "Clear cache"
docker-compose exec --user www-data -T typo3-php-fpm ./bin/typo3cms cache:flush