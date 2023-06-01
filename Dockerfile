FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

#Uncomment if needed
#RUN apt-get install -y nodejs \
#  && curl -L https://www.npmjs.com/install.sh | sh
#
#RUN cd /usr/local/etc/php/conf.d/ && \
#  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

RUN cd /usr/local/etc/php/conf.d/ && \
  printf 'post_max_size = 64M; \n upload_max_filesize = 64M;' >> /usr/local/etc/php/conf.d/docker-php-uploads.ini

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Allow user to execute Artisan/ Composer commands
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
