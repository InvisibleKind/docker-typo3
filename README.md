# Docker TYPO3 website

## Dev Umgebung einrichten

1. Docker herunterladen und installieren: https://www.docker.com/community-edition#/download
2. Repo clonen
3. Im Terminal in `docker/` Ordner reingehen
4. Verknüpfung zu dev-override erstellen: `ln -s docker-compose.dev.yml docker-compose.override.yml`
5. Containers bauen und starten: `docker-compose up -d`
6. In hosts-Datei reinfügen: `127.0.0.1 docker-typo3.dev` (/private/etc/hosts beim MacOS)
7. `composer install` im Projekt-root durchführen (entweder vom host-Machine oder vom Docker Container: `docker exec -it -u www-data typo3-php-fpm composer install`)
8. Website ist durch [http://docker-typo3.dev:1026/](http://docker-typo3.dev:1026/) erreichbar


**Hints**

Falls die Änderungen beim Docker-Image gemacht werden, muss man die Containers neu bauen und neu starten:
`docker-compose build && docker-compose restart`

Wenn viele Fehler beim Bauen sind ider die Änderungen nicht sichtabar sind, mus man `docker-compose build --no-cache` durchführen 

Manchmal muss man ein Cleanup machen von nicht mehr benutzte Containers, Images, Volumes, Networks usw: `docker system prune`