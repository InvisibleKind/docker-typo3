FROM typo3-php-fpm:base

LABEL maintainer="viktor.livakivskyi@oddity.agency"

RUN apt-get update \

    && apt-get -y install php-xdebug \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

#COPY php-ini-overrides.ini /etc/php/7.1/fpm/conf.d/99-overrides.ini

# Configure FPM
RUN sed -i "/pm.max_children = .*/c\pm.max_children = 15" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pm.start_servers = .*/c\pm.start_servers = 2" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pm.min_spare_servers = .*/c\pm.min_spare_servers = 1" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pm.max_spare_servers = .*/c\pm.max_spare_servers = 3" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;slowlog = .*/c\slowlog = /proc/self/fd/2" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;request_slowlog_timeout = .*/c\request_slowlog_timeout = 10s" /etc/php/7.1/fpm/pool.d/www.conf
    # Disabled until https://github.com/docker-library/php/issues/358 is fixed
    #&& sed -i "/;access.format = .*/c\access.format = \"%R - %u %t '%m %r%Q%q' %s %f cpu:%C%% mem:%{megabytes}M reqTime:%d\"" /etc/php/7.1/fpm/pool.d/www.conf