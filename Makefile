## ---------------------------------------------------------
## Comando base para docker-compose
## ---------------------------------------------------------

DOCKER_COMPOSE = docker compose -f ./.docker/docker-compose.yml

## ---------------------------------------------------------
## Inicialización de la Aplicación
## ---------------------------------------------------------

.PHONY: init-app
init-app: | copy-env create-symlink up permissions migracion print-urls

.PHONY: copy-env
copy-env:
	@ [ ! -f .env ] && cp .env.example .env || true

.PHONY: permissions
permissions:
	$(DOCKER_COMPOSE) exec php_apache_red_social chmod 777 -R storage
	$(DOCKER_COMPOSE) exec php_apache_red_social chmod 777 -R bootstrap

.PHONY: create-symlink
create-symlink:
	@ [ -L .docker/.env ] || ln -s ../.env .docker/.env

.PHONY: migracion
migracion:
	@echo "⏳ Esperando a que MySQL esté disponible..."
	@sleep 5  # Espera 5 segundos (ajustalo si es necesario)
	$(DOCKER_COMPOSE) exec php_apache_red_social php artisan migrate --seed
	@echo "Migraciones aplicadas!"


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

.PHONY: clean-docker
clean-docker:
	sudo docker stop $$(sudo docker ps -q) || true
	sudo docker rm $$(sudo docker ps -a -q) || true
	sudo docker rmi -f $$(sudo docker images -q) || true
	sudo docker volume rm $$(sudo docker volume ls -q) || true

.PHONY: shell
shell:
	$(DOCKER_COMPOSE) exec --user pablogarciajc php_apache_red_social  /bin/sh -c "cd /var/www/html/; exec bash -l"

.PHONY: rollback
rollback:
	$(DOCKER_COMPOSE) exec php_apache_red_social php artisan migrate:rollback


.PHONY: test
test:
	$(DOCKER_COMPOSE) exec php_apache_red_social php artisan test


