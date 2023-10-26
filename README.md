```
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app cp .env.example .env
docker-compose exec app php artisan jwt:secret
docker-compose exec app php artisan migrate
```

This repository has Postman Collection **Laravel.postman_collection.json**
