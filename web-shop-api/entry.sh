#!/bin/bash
service php7.3-fpm start
service nginx start
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=/usr/bin --filename=composer
chmod +x /usr/bin/composer
source ~/.bashrc
cd /var/www/html/web-shop-api
composer install
php -r "unlink('composer-setup.php');"
tail -f /dev/null