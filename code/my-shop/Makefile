COMPOSE=docker-compose.yml

.PHONY: db
db:
	docker-compose -f ${COMPOSE} up --wait -d mysql

.PHONY: mysql
mysql:
	docker exec -it my-shop-mysql-1 mysql -u root -psomeRootPassword

.PHONY: serve
serve:
	./scripts/serve_web.sh

.PHONY: init-db
serve:
	./scripts/init-db.sh
