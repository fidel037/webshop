#!/bin/bash

path=/var/www/html/webshop-full
mkdir $path
cd $path
git clone https://github.com/fidel037/webshop.git .
docker-compose build
docker-compose up
