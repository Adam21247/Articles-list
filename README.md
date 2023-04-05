Project installation
-----------
* `docker-compose up -d`
* `docker network create nginx-proxy`
* `cp .env.example .env` 
* `docker exec -i articles-system-laravel.test-1 composer install`
* `docker exec -i articles-system-laravel.test-1 php artisan key:generate`
* `docker exec -t articles-system-laravel.test-1 php artisan migrate:fresh --seed`

## Endpoints 

1. /api/articles/{id}
2. /api/articles/author/{authorId}
