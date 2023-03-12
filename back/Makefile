#-----------------------------------------------------------
# Docker
#-----------------------------------------------------------

# Start docker containers
start:
	docker-compose start

# Stop docker containers
stop:
	docker-compose stop

# Recreate docker containers
up:
	docker-compose up -d

# Stop and remove containers and networks
down:
	docker-compose down

# Stop and remove containers, networks, volumes and images
clean:
	docker-compose down --rmi local -v

# Restart all containers
restart: stop start

# Build and up docker containers
build:
	docker-compose build

# Build containers with no cache option
build-no-cache:
	docker-compose build --no-cache

# Build and up docker containers
rebuild: build up

env:
	[ -f .env ] && echo .env exists || cp .env.example .env

init: env up build install start

php-bash:
	docker exec -it --user=www-data f-php bash
node-sh:
	docker exec -it --user=node f-node sh

#-----------------------------------------------------------
# Installation
#-----------------------------------------------------------

# Laravel
install:
	docker-compose stop
	docker-compose up -d redis
	docker-compose run -u `id -u` --rm php composer i
	docker-compose run -u `id -u` --rm php php artisan key:generate
	docker-compose run -u `id -u` --rm php php artisan migrate:fresh --seed
	docker-compose run -u `id -u` --rm php php artisan storage:link
