#!/usr/bin/env bash

echo "Backuing up volumes"
cd /home/docker-typo3/backup/
docker run --rm --volumes-from typo3-mysql-main -v $(pwd):/backup ubuntu tar cvf /backup/mysql-main.tar /var/lib/mysql
docker run --rm --volumes-from typo3-mysql-sys -v $(pwd):/backup ubuntu tar cvf /backup/mysql-sys.tar /var/lib/mysql
docker run --rm --volumes-from typo3-php-fpm -v $(pwd):/backup ubuntu tar cvf /backup/fileadmin.tar /var/www/docker-typo3/web/fileadmin
docker run --rm --volumes-from typo3-php-fpm -v $(pwd):/backup ubuntu tar cvf /backup/uploads.tar /var/www/docker-typo3/web/uploads
