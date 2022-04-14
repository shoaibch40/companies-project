<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Deployment Steps
### Clone Project from repository
### Update .env file

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=******
- DB_USERNAME=***********
- DB_PASSWORD=
-
- MAIL_MAILER=smtp
- MAIL_HOST=smtp.mailtrap.io
- MAIL_PORT=2525
- MAIL_USERNAME=***********
- MAIL_PASSWORD=**************
- MAIL_ENCRYPTION=tls
- MAIL_FROM_ADDRESS=null
- MAIL_FROM_NAME="${APP_NAME}"

### Run follwing Commands
- **composer install**
- **php artisan migrate**
- **php artisan db:seed --class=AdminUser**
- **php artisan db:seed --class=CompaniesList**

### Admin Credientials
- **Email:**  admin@admin.com
- **Password:** password



