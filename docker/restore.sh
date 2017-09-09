#!/usr/bin/env bash

echo "Restoring last backup"
cd /home/docker-typo3/backup/

docker run --rm --volumes-from typo3-mysql-main -v $(pwd):/backup ubuntu bash -c "tar xvf /backup/mysql-main.tar -C /var --strip 1"
docker run --rm --volumes-from typo3-mysql-sys -v $(pwd):/backup ubuntu bash -c "tar xvf /backup/mysql-sys.tar -C /var --strip 1"
docker run --rm --volumes-from typo3-php-fpm -v $(pwd):/backup ubuntu bash -c "tar xvf /backup/fileadmin.tar -C /var --strip 1"
docker run --rm --volumes-from typo3-php-fpm -v $(pwd):/backup ubuntu bash -c "tar xvf /backup/uploads.tar -C /var --strip 1"