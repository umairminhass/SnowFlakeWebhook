FROM php:8.2-apache


RUN su -

# Install dependencies
RUN apt-get update && apt-get install -y \
    unixodbc \
    unixodbc-dev \
    odbcinst \
    libssl-dev \
    libcurl4 \
    libkrb5-3 \
    wget \
    gnupg \
    && rm -rf /var/lib/apt/lists/*
	
# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Download and install Snowflake ODBC Driver (update version if needed)
RUN wget -O snowflake-odbc.deb https://sfc-repo.snowflakecomputing.com/odbc/linux/3.6.0/snowflake-odbc-3.6.0.x86_64.deb \
    && dpkg -i snowflake-odbc.deb \
    && rm snowflake-odbc.deb

# Copy ODBC configuration files
COPY odbcinst.ini /etc/odbcinst.ini
COPY odbc.ini /etc/odbc.ini

# Set environment variables
ENV ODBCINI=/etc/odbc.ini
ENV ODBCINSTINI=/etc/odbcinst.ini
ENV LD_LIBRARY_PATH=/usr/lib/snowflake/odbc/lib:/usr/lib/x86_64-linux-gnu:$LD_LIBRARY_PATH

# Ensure proper permissions for ODBC configuration
RUN chmod 777 /etc/odbc.ini /etc/odbcinst.ini && \
    chmod -R 755 /usr/lib/snowflake/odbc/lib
	
# create a symlink for the missing libodbcinst.so.1
RUN ln -s /usr/lib/x86_64-linux-gnu/libodbcinst.so.2 /usr/lib/x86_64-linux-gnu/libodbcinst.so.1

# Copy database.sql file
COPY hubspot.sql /docker-entrypoint-initdb.d/

# Enable Apache rewrite module if needed
RUN a2enmod rewrite

# Copy your PHP application files
COPY . /var/www/html

# Expose port and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
