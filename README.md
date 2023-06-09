#Para instalar proyecto

composer update
| composer install
| php artisan key:generate
| php artisan migrate
| php artisan db:seed --class=DatabaseSeeder

php artisan clear-compiled 
| composer dump-autoload
| php artisan optimize

#Para desarrollar

php artisan serve => levanta el servidor de laravel