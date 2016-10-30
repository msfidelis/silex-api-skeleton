# SilexPHP-API-Skeleton
API criada utilizando o microframework Silex com o ORM Doctrine. 

* Modifiquei a arquitetura pra utilizar o padrão MVC na construção de API's de maneira simples e robusta :)

## Exemplo do htaccess

```
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

```
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
