# Silex PHP MVC - Fast API :rocket: :space_invader: :octocat:
Exemplos de API criada utilizando o microframework Silex com o ORM Doctrine. 
Criei essa paradinha pra não precisar ficar horas configurando o ambiente do Silex sempre que precisar construir uma API simples com PHP. Já ta tudo aí :D 

* Modifiquei a arquitetura pra utilizar o padrão MVC na construção de API's de maneira simples e robusta :)

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


* Vai precisar ler um poquinho sobre o [Silex PHP](http://silex.sensiolabs.org/doc/master/), esse microframework PHP voltado para construção de API de forma ágil

* Leia também sobre o [Doctrine ORM](http://docs.doctrine-project.org/en/latest/) e o [Doctrine Query Builder](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html). Gastei um tempinho abstraindo as coisas pra deixar um MVC mais amigável pra manipilação de dados mais modular 

* Da uma passadinha na documentação do [Twig](http://twig.sensiolabs.org/) também. Esse manipulador de View é dahora pra caramba de tão simples

* Lembrando que o Silex usa vários componentes do [Symfony Framework](https://symfony.com/) . Talvez a documentação te ajude em algum momento. 
