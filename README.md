Project installation
-----------
* `docker-compose up -d`
* `docker network create nginx-proxy`
* `cp .env.example .env` 
* `docker exec -i articles-system-laravel.test-1 composer install`
* `docker exec -i articles-system-laravel.test-1 php artisan key:generate`
* `docker exec -t articles-system-laravel.test-1 php artisan migrate:fresh --seed`

## WEB CMS
1. http://localhost:8000/login
2. http://localhost:8000/articles


## API Endpoints 

1. /api/articles
2. /api/articles/{id}
3. /api/articles/delete/{id}
4. /api/articles/store
5. /api/articles/{id}/update
