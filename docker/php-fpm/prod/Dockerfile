FROM typo3-php-fpm:base

LABEL maintainer="viktor.livakivskyi@oddity.agency"

COPY ./ /var/www/docker-typo3
WORKDIR "/var/www/docker-typo3"

# Configure FPM
RUN sed -i "/pm.max_children = .*/c\pm.max_children = 30" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pm.start_servers = .*/c\pm.start_servers = 10" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pm.min_spare_servers = .*/c\pm.min_spare_servers = 5" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pm.max_spare_servers = .*/c\pm.max_spare_servers = 10" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;slowlog = .*/c\slowlog = /proc/self/fd/2" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;request_slowlog_timeout = .*/c\request_slowlog_timeout = 10s" /etc/php/7.1/fpm/pool.d/www.conf
    # Disabled until https://github.com/docker-library/php/issues/358 is fixed
    #&& sed -i "/;access.format = .*/c\access.format = \"%R - %u %t '%m %r%Q%q' %s %f\"" /etc/php/7.1/fpm/pool.d/www.conf

# Create a necessary folder before mounting volumes to apply correct owner:group, instead of root:root (default by new volumes with missing folder in container)
RUN chmod 2755 web/ \
    && mkdir -p web/fileadmin && chmod 2755 web/fileadmin \
    && mkdir -p web/typo3conf/l10n && chmod 2755 web/typo3conf/l10n \
    && mkdir -p web/typo3conf/ext && chmod 2755 web/typo3conf/ext \
    && mkdir -p web/typo3temp && chmod 2755 web/typo3temp \
    && mkdir -p web/uploads && chmod 2755 web/uploads

# TODO: this can be moved out of Docker to build system (Jenkins, Gitlab CI)
RUN composer install --no-dev -n -o && ./bin/typo3cms install:fixfolderstructure \
    && echo "Reducing size of container" && rm -rf composer-cache \
    && echo "Changing project owner to www-data" && chown -R www-data:www-data ./ \
    && echo "Removing write rights for unprivileged users" && chmod -R g-w,o-w ./ \
    && echo "Removing write rights from sources" && chmod -R -w vendor/