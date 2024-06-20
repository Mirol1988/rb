include .env
export $(shell sed 's/=.*//' .env)

up:
	docker-compose up -d --build

down:
	docker-compose down

restart:
	docker-compose down
	docker-compose rm
	docker-compose up -d --build --remove-orphans

init:
	cp .env.example .env
	echo Отредактируйте файл .env чтобы настроить свои переменные окружения!!
	docker network create 2035.local

build:
	docker-compose build

test:
	docker-compose exec Rb vendor/bin/phpunit --coverage-clover test/phpunit.coverage.xml --log-junit test/phpunit.report.xml

rebuild:
	docker-compose build --no-cache
