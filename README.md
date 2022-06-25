# Description
See `/docs/index.md`
# Installation: fast start ###
copy .ENV vars from .env.sqlite.example

- composer install
- php artisan migrate:fresh --seed
- php artisan serve

go to http://127.0.0.1:8000/api/shops?apikey=123
