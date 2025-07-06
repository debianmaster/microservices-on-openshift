# Use PHP 7.4 with Apache base image
FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Copy all PHP files and static assets
COPY index.php .
COPY login.php .
COPY register.php .
COPY friends.php .
COPY profile.php .
COPY tweets.php .
COPY hack.php .
COPY head.php .
COPY style.css .
COPY script.js .

# Set environment variables for backend service URLs
ENV USER_REG_SVC=""
ENV TWITTER_FEED_SVC=""

# Expose port 80 (Apache default)
EXPOSE 80

# Apache is already configured to serve PHP files in the base image
# The default CMD starts Apache in the foreground

