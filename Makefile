include ./.env

start:
	$(MAKE) kill clean install

kill:
	docker kill $$(docker ps -q)

clean:
	docker system prune -a -f --volumes

install:
	chmod -R 0777 $(CURDIR)
	docker-compose -f ./docker/docker-compose.yaml up -d --build
	chmod -R 0777 $(CURDIR)

push:
	$(MAKE) git-config
	git add .
	git commit -m "[`date +'%Y-%m-%d'`] - work in progress."
	git push

git-config:
	git config user.name $(GIT_NAME)
	git config user.email $(GIT_EMAIL)

webserver:
	docker exec -it webserver bash

status:
	@echo "**************************************************"
	docker ps -a
	@echo "**************************************************"
	docker images
	@echo "**************************************************"
	docker volume ls
	@echo "**************************************************"

migrate:
	docker exec webserver bash -c 'php artisan migrate:install; php artisan migrate:fresh'

seed:
	docker exec webserver bash -c 'php artisan db:seed'

chatbot:
	docker exec -it rasa bash