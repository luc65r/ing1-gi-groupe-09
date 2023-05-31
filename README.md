# Projet ING1 GI 2023

## Mode développement

Prérequis :
- PHP >= 7.4
- composer
- sqilte3
- php-sqlite3
- npm et node récents

```
composer install
npm install
npm run dev
touch database/database.sqlite
php artisan migrate
php artisan db:seed
php artisan serve
```

## Mode production

Il y a un docker : `luc65r/ing1-gi-groupe-09`
