### Passo a passo
Clone Repositório
```sh
git clone -b laravel-10-com-php-8.1 https://github.com/rafPH1998/teste-dc-tecnologia
```
```sh
cd teste-dc-tecnologia
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Acesse a rota para fazer um registro e logar no sistema
```sh
http://localhost:8000/registrar
```
logue no sistema
```sh
http://localhost:8000/login
```


Acesse o projeto
[http://localhost:8989](http://localhost:8000)
