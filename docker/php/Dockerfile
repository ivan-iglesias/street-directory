ARG VERSION
FROM php:${VERSION}

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev && \
    docker-php-ext-install \
        zip \
        intl \
        mysqli \
        pdo pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Xdebug
ARG XDEBUG=false
RUN if [ "$XDEBUG" = "true" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug \
;fi

# Configure non-root user
ARG UID=1000
ARG GID=1000
RUN groupadd -g $GID devuser && useradd -m -u $UID  -g $GID devuser
USER devuser

# Set working directory
ARG APP_NAME
COPY src/ /var/www/${APP_NAME}
WORKDIR /var/www/${APP_NAME}/
