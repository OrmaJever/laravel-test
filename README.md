```
docker-compose up -d
docker-compose exec app composer install
docker-compose exec cp .env.example .env
docker-compose exec php artisan jwt:secret
docker-compose exec php artisan migrate
```

This repository has Postman Collection **Laravel.postman_collection.json**
