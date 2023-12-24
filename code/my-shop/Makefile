COMPOSE=docker-compose.yml

.PHONY: mysql
mysql:
	docker-compose -f ${COMPOSE} up --wait -d mysql

.PHONY: run
run:
	./run_php.sh