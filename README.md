# Projet ING1 GI 2023

## Mode développement

Prérequis :
- PHP >= 7.4
- composer
- sqlite3
- php-sqlite3
- Node.js et npm récents ([Note Version Manager](https://github.com/nvm-sh/nvm))

```
composer install
mv .env.example .env
php artisan key:generate
npm install
npm run dev
touch database/database.sqlite
php artisan migrate
php artisan db:seed
php artisan serve
```

Le site se trouve à l'adresse `localhost:8000`.

## Mode production

Il y a un docker : `luc65r/ing1-gi-groupe-09`

Pour le lancer :
```
docker run --rm -t -p 9000:80 luc65r/ing1-gi-groupe-09:latest
```

Le site se trouve à l'adresse `localhost:9000`.
