# Silex PHP MVC - Fast API :rocket: :space_invader: :octocat:
Exemplos de API criada utilizando o microframework Silex com o ORM Doctrine.
Criei essa paradinha pra não precisar ficar horas configurando o ambiente do Silex sempre que precisar construir uma API simples com PHP. Já ta tudo aí­ :D

* Modifiquei a arquitetura pra utilizar o padrÃ£o MVC na construção de API's de maneira simples e robusta :)

#Docker Stacks :whale:

## PHP7 on Cli

Containers de PHP7 (Servidor Interno) + MySQL - Não recomendado para produção, somente para desenvolvimento e testes

```
    docker-compose -f docker-compose-cli.yml up
```

## PHP7-FPM + NGinx

Containers de PHP7 utilizando uma arquitetura FPM + MySQL . - Bom para API's com alta concorrência.

```
    docker-compose -f docker-compose-nginx.yml up
```

## PHP7 apacheconf

Containers de PHP7 + Apache + MySQL

```
    docker-compose -f docker-compose-apache.yml up
```

# PHP CLI

```
 php -S 0.0.0.0:80 web/
```

# Apache

## Exemplo do htaccess

``` apacheconf
<IfModule mod_rewrite.c>
    Options -MultiViews

    RewriteEngine On
    #RewriteBase /path/to/app
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [QSA,L]
</IfModule>

```

## Exemplo do VHOST

``` apacheconf
<VirtualHost *:80>
        DocumentRoot "/Users/fidelis/Sites/Api-Web/web/"
        Servername local.apiweb.com
        DirectoryIndex index.php
        <Directory "/Users/fidelis/Sites/Api-Web/web/">
            AllowOverride All
            Allow from All
        </Directory>
</VirtualHost>
```

# Começando

* Você vai precisar do [composer!](https://getcomposer.org/)

``` bash
 # curl -s -o /usr/local/bin/composer https://getcomposer.org/composer.phar
 # chmod 0755 /usr/local/bin/composer
```

E na pasta do projeto, onde se encontra nosso arquivinho composer.json:

``` bash
 # composer install
```

# Testes  

Para rodar os testes, você pode utilizar o PHPunit diretamente ou aproveitar o alias do compose que eu criei

```
  composer test
```


# Migrations

Adicionei o Doctrine Migrations pra automatizar meus deploys e testes em schemas de bancos de dados.

* Gerar uma nova migration

```
  php console.php migrations:generate

  # Loading configuration from file: migrations.yml
  # Generated new migration class to "/Users/matheus/Workspace/SilexPHP-API-Skeleton/web/src/Migrations/Version20170215004833.php"
```

* Rodar as Migrations

```
  php console.php migrations:migrate
```



* Vai precisar ler um poquinho sobre o [Silex PHP](http://silex.sensiolabs.org/doc/master/), esse microframework PHP voltado para construção de API's de forma Ágil

* Leia também sobre o [Doctrine ORM](http://docs.doctrine-project.org/en/latest/) e o [Doctrine Query Builder](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html). Gastei um tempinho abstraindo as coisas pra deixar um MVC mais amigÃ¡vel pra manipulação de dados mais modular

* Da uma passadinha na documentação do [Twig](http://twig.sensiolabs.org/) também. Esse manipulador de View da dahora pra caramba de tão simples

* Lembrando que o Silex usa vários componentes do [Symfony Framework](https://symfony.com/) . Talvez a documentação te ajude em algum momento.

# CRUD Teste 

* Migrations 

Será necessário rodar as migrations já existentes

```
$ php console.php migrations:migrate
```

### POST - Create Employee

```bash
$ curl -H "Content-type: application/json" \
    -d '{"name": "Matheus Fidelis", "age":"21", "salary":200}' \
    -X POST localhost/employee/ -i 
```

```
HTTP/1.1 201 Created
Server: nginx/1.6.2
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.0.17
Cache-Control: no-cache, private
Date: Sat, 13 May 2017 12:03:53 GMT
X-Symfony-Cache: POST /employee/: pass, invalidate

{"id":"25","name":"\u0027Matheus Fidelis\u0027","age":"21","salary":"200"}
```

### GET - List all Employees

```bash
$ curl -H "Content-type: application/json" \
    -X GET localhost/employee/ -i 
```

```
HTTP/1.1 200 OK
Server: nginx/1.6.2
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.0.17
Cache-Control: no-cache, private
Date: Sat, 13 May 2017 12:06:59 GMT
X-Symfony-Cache: GET /employee/: miss

[{"id":"1","name":"\u0027Matheus Fidelis\u0027","age":"21","salary":"200"},{"id":"2","name":"\u0027Matheus Fidelis\u0027","age":"21","salary":"200"},{"id":"3","name":"\u0027Matheus Fidelis\u0027","age":"21","salary":"200"}]
```

### GET - List a single Employee

```bash
$ curl -H "Content-type: application/json" \
    -X GET localhost/employee/1 -i 
```

```yml
HTTP/1.1 200 OK
Server: nginx/1.6.2
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.0.17
Cache-Control: no-cache, private
Date: Sat, 13 May 2017 12:07:24 GMT
X-Symfony-Cache: GET /employee/1: miss

{"id":"1","name":"\u0027Matheus Fidelis\u0027","age":"21","salary":"200"}
```

### PUT - Update a employee

```bash
$ curl -H "Content-type: application/json" \
    -d '{"name": "Matheus Fidelis - Changed!", "age":"21", "salary":200}' \
    -X PUT localhost/employee/1 -i 
```

```yml
HTTP/1.1 200 OK
Server: nginx/1.6.2
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.0.17
Cache-Control: no-cache, private
Date: Sat, 13 May 2017 12:11:53 GMT
X-Symfony-Cache: PUT /employee/1: pass, invalidate

{"id":"1","name":"Matheus Fidelis - Changed!!!","age":"21","salary":"200"}
```

### DELETE - Delete a Employee

```bash
$ curl -H "Content-type: application/json" \
    -X DELETE localhost/employee/1 -i 
```

```yml
HTTP/1.1 204 No Content
Server: nginx/1.6.2
Content-Type: text/html; charset=UTF-8
Connection: keep-alive
X-Powered-By: PHP/7.0.17
Cache-Control: no-cache, private
Date: Sat, 13 May 2017 12:15:04 GMT
X-Symfony-Cache: DELETE /employee/1: pass, invalidate
```