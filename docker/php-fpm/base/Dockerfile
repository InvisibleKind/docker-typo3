FROM phpdockerio/php71-fpm:latest

LABEL maintainer="viktor.livakivskyi@oddity.agency"

# Install selected extensions and other stuff (poppler-utils, unzip, catdoc needed for indexed_search PDF/DOC/DOCX indexing)
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.1-mysql php-redis php7.1-gd php-imagick php7.1-mbstring php7.1-soap graphicsmagick ghostscript locales poppler-utils unzip catdoc \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Make access.log output to STDOUT (default in phpdockerio/php71-fpm is STDERR)
RUN sed -i "/access.log = .*/c\access.log = /proc/self/fd/1" /etc/php/7.1/fpm/pool.d/www.conf

# Add German UTF-8 locale
RUN locale-gen "de_DE.UTF-8"

COPY php-ini-overrides.ini /etc/php/7.1/fpm/conf.d/90-overrides.ini
COPY opcacheBlacklist.txt /etc/php/7.1/fpm/opcacheBlacklist.txt

#RUN mkdir -p /var/www && \
#    chown -R www-data:www-data /var/www

WORKDIR "/var/www/docker-typo3"