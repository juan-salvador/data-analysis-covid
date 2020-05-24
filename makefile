IMAGE_NAME = data-analisys

build:
	docker build -t ${IMAGE_NAME} docker/.

up:
	docker run -d -v $(PWD)/app:/app -p 80:80 --name web ${IMAGE_NAME}

stop:
	docker stop web
	docker rm -f web

entry:
	docker exec -it web bash