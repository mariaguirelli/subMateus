## requisitos 
* PHP 8.3 ou superior
* MySQL 8 ou superior
* Composer

## Como rodar o projeto baixado

Duplicar o arquivo "env.example" e renomear para ".env". <br> 
Alterar no arquivo .env as credenciais do banco de dados <br>

Instalar as dependências do PHP
````
composer install
````
Gerar a chave no arquivo .env
````
php artisan key:generate
````
Executar as migration: php artisan migrate
````
Executar as seed: php artisan db:seed
````

## Sequencia para criar o projeto

Criar o projeto com Laravel
````
composer create-project laravel/laravel api-laravel
````
Alterar no arquivo env. as credenciasis do banco de dados <br>

Criar o arquivo de rotas para API
````
php artisan install:api