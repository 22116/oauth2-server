FROM oauth2-server:latest

RUN apk --update --no-cache add autoconf g++ make && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ make

ENV XDEBUG_HOST='docker.for.mac.localhost'
ENV XDEBUG_IDEKEY='Docker'
ENV XDEBUG_PATH=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Enable Remote xdebug
RUN echo "memory_limit=-1" >> /usr/local/etc/php/php.ini && \
    echo "xdebug.default_enable = 0" >> ${XDEBUG_PATH} && \
    echo "xdebug.idekey = ${XDEBUG_IDEKEY}" >> ${XDEBUG_PATH} && \
    echo "xdebug.remote_enable = 1" >> ${XDEBUG_PATH} && \
    echo "xdebug.remote_autostart = 1" >> ${XDEBUG_PATH} && \
    echo "xdebug.remote_connect_back = 0" >> ${XDEBUG_PATH} && \
    echo "xdebug.profiler_enable = 0" >> ${XDEBUG_PATH} && \
    echo "xdebug.remote_host = ${XDEBUG_HOST}" >> ${XDEBUG_PATH}
