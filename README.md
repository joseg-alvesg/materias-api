
```
# para iniciar os containers
docker compose up -d

# para popular as tabelas com exemplo
php artisan app:migration
php artisan app:seeder

# caso precise reiniciar o db
php artisan app:refresh-seed
```

###  to-do:
- [ ] crud.
    - [x] get all
        - [x] render
        - [x] css
    - [x] get by id
        - [x] render
        - [x] css
    - [x] post
        - [x] form
        - [x] save
    - [ ] put
    - [ ] delete
- [ ] melhorias
    - [ ] css
    - [ ] design
- [ ] ...
