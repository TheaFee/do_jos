#!/usr/bin/env bash

#docker image rm php:7.4-apache-gd

#docker build -t php:7.4-apache-gd .

docker run -p 80:80 -it --rm -v "$(pwd)":/var/www/html --name jpgraph-run php:7.4-apache-gd


