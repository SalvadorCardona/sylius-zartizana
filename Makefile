CONTAINER_NAME_PHP=zartizana_php
CONTAINER_NAME_NODE=zartizana_node
PHP_CMD=docker exec $(CONTAINER_NAME_PHP)
NODE_CMD=docker exec $(CONTAINER_NAME_NODE)

bash-php:
	docker exec -it $(CONTAINER_NAME_PHP) sh

bash-node:
	docker exec -it $(CONTAINER_NAME_NODE) sh

trans:
	$(PHP_CMD) php bin/console translation:extract --force fr --format json

api-schema:
	$(PHP_CMD) bin/console api:openapi:export  -o ./api.json
	$(NODE_CMD) npx openapi-typescript api.json --output ./front/src/schema/app-api-schema.ts
	rm -f api.json

server-dev:
	docker-compose up
