CONTAINER_PREFIX := streetdirectory_
COMPOSE_FILE_PATH := -f docker-compose.yml

all:
	@-exit 1

build:
	@docker-compose $(COMPOSE_FILE_PATH) build --no-cache

up:
	@docker-compose $(COMPOSE_FILE_PATH) up -d

down:
	@docker-compose $(COMPOSE_FILE_PATH) down

start:
	@docker-compose $(COMPOSE_FILE_PATH) start

stop:
	@docker-compose $(COMPOSE_FILE_PATH) stop

top:
	@docker-compose $(COMPOSE_FILE_PATH) top

ps:
	@docker ps -a

clean:
	@docker system prune --volumes --force

log:
	@read -p "Service name: " SERVICE; \
	docker-compose $(COMPOSE_FILE_PATH) logs -f $$SERVICE

goto:
	@read -p "Service name: " SERVICE; \
	docker exec -it $(CONTAINER_PREFIX)$$SERVICE bash
