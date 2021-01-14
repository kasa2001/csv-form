# 🐳 Docker + PHP 7.4 + MySQL + Nginx + Symfony 5 Boilerplate

## Description

This is a complete stack for running Symfony 5 into Docker containers using docker-compose tool.

It is composed by 3 containers:

- `nginx`, acting as the webserver.
- `php`, the PHP-FPM container with the 7.4 PHPversion.
- `db` which is the MySQL database container with a **MySQL 8.0** image.

## Installation

1. Run `docker-compose up -d`
1. Enter php container `docker exec -it symfony-training_php_1 bash`
1. Install symfony:
```
curl -sS https://get.symfony.com/cli/installer | bash

mv /root/.symfony/bin/symfony /usr/local/bin/symfony

symfony new symfony --dir=/var/www/symfony
```

Symfony can be accesible by: http://localhost:8001/
