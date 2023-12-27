include .env

install: docker-build up composer-install
down: docker-down
up: docker-up
restart: docker-down docker-up

docker-build: \
	docker-build-php-fpm \
	docker-build-nginx \

docker-up:
	@echo "docker up"
	@docker-compose up --build -d

docker-down:
	@echo "docker down"
	@docker-compose down --remove-orphans

docker-build-php-fpm:
	@docker build --target=fpm -t ${REGISTRY}/${PHP_FPM_CONTAINER_NAME}:${IMAGE_TAG} -f ./docker/Dockerfile .

docker-build-nginx:
	@docker build --target=nginx -t ${REGISTRY}/${NGINX_CONTAINER_NAME}:${IMAGE_TAG} -f ./docker/Dockerfile .

composer-install:
	@docker-compose -f docker-compose.yml exec php-fpm composer install

shell:
	@docker-compose -f docker-compose.yml exec php-fpm /bin/sh
