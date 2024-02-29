
```
# para iniciar os containers
docker compose up -d

# para popular as tabelas com exemplos de fora do container
php artisan app:migration
php artisan app:seeder

# caso precise reiniciar o db
php artisan app:refresh-seed
```

###  to-do:
