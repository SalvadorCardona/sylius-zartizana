CONTAINER_NAME_PHP=sylius-zartizana_php-fpm_1
CONTAINER_NAME_NODE=zartizana_node
PHP_CMD=docker exec $(CONTAINER_NAME_PHP)
NODE_CMD=docker exec $(CONTAINER_NAME_NODE)
USER_ID=$(id -u)
GROUP_ID=$(id -g)

bash-php:
	docker exec -it $(CONTAINER_NAME_PHP) bash

bash-node:
	docker exec -it $(CONTAINER_NAME_NODE) sh

trans:
	$(PHP_CMD) php bin/console translation:extract --force fr --format json

api-schema:
	$(PHP_CMD) bin/console api:openapi:export  -o ./api.json
	$(NODE_CMD) npx openapi-typescript api.json --output ./front/src/schema/app-api-schema.ts
	rm -f api.json

start-prod:
	APP_ENV=prod docker-compose -f docker-compose.prod.yml up -d

start-dev:
	APP_ENV=dev docker-compose up

lint:
	$(PHP_CMD) vendor/bin/phpcs
	$(PHP_CMD) vendor/bin/phpstan analyse

lint-fix:
#	$(PHP_CMD) vendor/bin/phpcs
	$(PHP_CMD) vendor/bin/php-cs-fixer fix src

rector:
	$(PHP_CMD) vendor/bin/rector process src
