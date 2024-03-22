#!/usr/bin/env bash

echo -e "++++++++++++++++ Install Lara ++++++++++++++++++++++"
docker-compose rm
docker-compose up -d --build

docker exec -it lara composer install
docker exec -it lara cp .env.example .env
docker exec -it lara php artisan key:generate
docker exec -it lara php artisan migrate:fresh
docker exec -it lara php artisan db:seed
docker exec -it lara php artisan storage:link
docker exec -it lara chmod 777 storage/logs -R
docker exec -it lara chmod 777 storage/framework -R


echo -e "++++++++++++++++ System installed success ++++++++++++++++++++++"
