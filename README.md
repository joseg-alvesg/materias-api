## materias API

### uso:

para iniciar os containers
```bash
docker compose up -d
```

para popular as tabelas com exemplos de fora do container

funciona para reiniciar o container
```bash
php artisan app:seeder

# caso queira um db limpo
# substitua co comando de cima por esse
docker exec -it php artisan migrate --force
```

copie o arquivo .env pré configurado para acesso padrão

altere as chaves de DB conforme necessario
```bash
cp .env.example .env
```

geração da chave da maquina
```bash
php artisan key:generate
```

de dentro do container
```bash
docker exec -it laravel bash
php artisan migrate:fresh --seed --force
```
### Visuzalização
laravel rodando em: <http://localhost:8007>

mysql rodando em <http://localhost:3308>
