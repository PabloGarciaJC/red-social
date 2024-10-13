## ---------------------------------------------------------
## Comando base para docker-compose
## ---------------------------------------------------------

DOCKER_COMPOSE = docker-compose -f ./.docker/docker-compose.yml

## ---------------------------------------------------------
## Inicialización de la Aplicación
## ---------------------------------------------------------

.PHONY: init-app
init-app: | copy-env set-permissions create-symlink up print-urls

.PHONY: copy-env
copy-env:
	@ [ ! -f .env ] && cp .env.example .env || true

.PHONY: set-permissions
set-permissions:
	@echo "Estableciendo propietario y permisos..."
	@sudo chown -R pablogarciajc:pablogarciajc storage || true
	@chmod -R 777 storage || true
	@sudo chown -R pablogarciajc:pablogarciajc bootstrap/cache || true
	@chmod -R 777 bootstrap/cache || true
	@sudo chown -R pablogarciajc:pablogarciajc vendor || true
	@chmod -R 777 vendor || true
	@sudo chown -R pablogarciajc:pablogarciajc .env || true
	@chmod 664 .env || true
	@sudo chown -R pablogarciajc:pablogarciajc storage/logs || true
	@chmod -R 777 storage/logs || true
	@sudo chown -R pablogarciajc:pablogarciajc public || true
	@chmod -R 777 public || true
	@sudo chown -R pablogarciajc:pablogarciajc node_modules || true
	@chmod -R 777 node_modules || true
	@echo "Propietarios y permisos establecidos correctamente."

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

.PHONY: shell
shell:
	$(DOCKER_COMPOSE) exec --user pablogarciajc php_apache_red_social  /bin/sh -c "cd /var/www/html/; exec bash -l"
