# PrivateShare
PrivateShare is an opensource WeTransfer alternative running on PHP & OpenSSL and NO Database. 

- [Requirements](https://github.com/Dunky13/PrivateShare/tree/master#requirements)
- [Demo](https://github.com/Dunky13/PrivateShare/tree/master#demo)

## Requirements
- PHP 5+
  - mod_rewrite
  - mod_auth_basic
- OpenSSL

Change the `.htaccess` file in the `www` folder to set the max upload file of PHP. Default is set to `5GB`.

Change the Apache VirtualHost to redirect some urls:
  `/var/www/upload` is just an example, change this to suit your webserver.
```apache
DocumentRoot /var/www/upload
<Directory /var/www/upload/>
    AllowOverride all
    Require all granted
</Directory>
<Directory /var/www/upload/priv>
    AllowOverride all
    Require all valid-user
</Directory>
RewriteEngine on
RewriteRule ^/f/(.*)$ /get.php?file=$1 [L]
RewriteRule ^/e/([^/]+)/(.*)$ /get.php?enc=$1&file=$2 [L]
RewriteRule ^/d/(.*)$ /priv/delete.php?file=$1 [L]
```

## Demo
[Demo](https://share.went.io)
