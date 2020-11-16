container=dd-for-php

init:
	docker-compose build
	docker-compose up -d
	docker-compose exec $(container) composer install

up:
	docker-compose up -d

down:
	docker-compose down

ps:
	docker-compose ps

test:
	docker-compose exec $(container) vendor/bin/phpunit tests

composer:
	docker-compose exec $(container) composer $(CMD)

cs-check:
	docker-compose exec $(container) composer cs-check

cs-fix:
	docker-compose exec $(container) composer cs-fix