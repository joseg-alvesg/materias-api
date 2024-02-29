##materias API

###uso:
```
# para iniciar os containers
docker compose up -d

# para popular as tabelas com exemplos de fora do container
php artisan app:seeder
#funciona para reiniciar o container

# copia o arquivo .env pré configurado para acesso padrão
# altere as chaves de DB conforme necessario
cp .env.example .env

# geração da chave da maquina
php artisan key:generate

# de dentro do container
docker exec -it laravel bash
php artisan migrate:fresh --seed --force
```

### Visuzalização
laravel rodando em: http://localhost:8007
mysql rodando em localhost:3308
