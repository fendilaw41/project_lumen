composer install
cp .env.development to .env
php artisan migrate
php artisan db:seed