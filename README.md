# PrivateShare
PrivateShare is an opensource WeTransfer alternative running on PHP & OpenSSL and NO Database. 

- [Requirements](https://github.com/Dunky13/PrivateShare/tree/master#requirements)
- [Apache config](https://github.com/Dunky13/PrivateShare/tree/master#apache)
- [Nginx config](https://github.com/Dunky13/PrivateShare/tree/master#nginx)
- [Demo](https://github.com/Dunky13/PrivateShare/tree/master#demo)

## Requirements
- PHP 5+
  - mod_rewrite
  - mod_auth_basic
- OpenSSL

Change the `.htaccess` file in the `www` folder to set the max upload file of PHP. Default is set to `5GB`.

### Apache
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

### Nginx
Change the Nginx site config to redirect some urls:
  `/var/www/upload` is just an example, change this to suit your webserver.
```nginx
root /var/www/upload/;

client_max_body_size 5G;

location / {
	index index.php;
	aio threads;
}
location /f/ {
	aio threads;
	directio 16M;
	output_buffers 2 1M;
	alias /var/www/upload/f/;
}

location ^~ /priv/ {
	auth_basic      "Login";
	auth_basic_user_file    /etc/nginx/passwd/.htpasswd;
}
rewrite ^/e/([^/]+)/(.*)$ /get.php?enc=$1&file=$2;
rewrite ^/d/(.*)$ /priv/delete.php?file=$1;
```

## Demo
[Demo](https://share.went.io)
