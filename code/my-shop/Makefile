COMPOSE=docker-compose.yml

.PHONY: mysql
mysql:
	docker-compose -f ${COMPOSE} up --wait -d mysql

.PHONY: run
run:
	php -S localhost:8000 -t ./src/main