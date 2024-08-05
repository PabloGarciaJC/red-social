## ---------------------------------------------------------
## Comando base para docker-compose
## ---------------------------------------------------------

# DOCKER_COMPOSE = docker-compose -f ./.docker/docker-compose.yml
DOCKER_COMPOSE = docker-compose -f docker-compose.yml

## ---------------------------------------------------------
## Inicialización de la Aplicación
## ---------------------------------------------------------

.PHONY: init-app
init-app: | copy-env up print-urls

.PHONY: copy-env
copy-env:
	@ [ ! -f .env ] && cp .env.example .env

.PHONY: set-permissions
set-permissions:
	@chmod -R 777 ./config/.log
	@chmod g+s ./config/.log

# .PHONY: refresh-dependencies
# refresh-dependencies:
# 	docker exec -it php-apache-pablogarciajc bash -c "\
# 		composer update > /dev/null 2>&1 && \
# 		chown -R www-data:www-data /var/www/html/storage && \
# 		chown -R www-data:www-data /var/www/html/bootstrap/cache"

.PHONY: create-symlink
create-symlink:
	@ [ -L .docker/.env ] || ln -s ../.env .docker/.env

.PHONY: print-urls
print-urls:
	@echo "## Acceso a la Aplicación:   http://localhost:8081/"
	@echo "## Acceso a PhpMyAdmin:      http://localhost:8082/"


## ---------------------------------------------------------
## Gestión de Contenedores
## ---------------------------------------------------------

.PHONY: content-apache
content-apache:
	docker exec -it php-apache-pablogarciajc bash

.PHONY: up
up:
	$(DOCKER_COMPOSE) up -d

.PHONY: down
down:
	$(DOCKER_COMPOSE) down

.PHONY: restart
restart:
	$(DOCKER_COMPOSE) restart

.PHONY: ps
ps:
	$(DOCKER_COMPOSE) ps

.PHONY: logs
logs:
	$(DOCKER_COMPOSE) logs

.PHONY: build
build:
	$(DOCKER_COMPOSE) build

.PHONY: stop
stop:
	$(DOCKER_COMPOSE) stop
