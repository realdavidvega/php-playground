COMPOSE=docker-compose.yml

.PHONY: mysql
mysql:
	docker-compose -f ${COMPOSE} up --wait -d mysql

.PHONY: run
run:
	php -S src/app