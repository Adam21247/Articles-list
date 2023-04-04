Project installation

docker-compose up -d
docker network create nginx-proxy
cp .env.example .env
docker exec -i articles-system-laravel.test-1 composer install
docker exec -i articles-system-laravel.test-1php artisan key:generate
docker exec -t articles-system-laravel.test-1php artisan migrate:fresh --seed

Endpoints
/api/articles/{id}
/api/articles/author/{authorId}
