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
Les identifiants de l'administrateur par défaut :
- Courriel : admin@example.org
- Mot de passe : admin

## Mode production

Il y a un docker : [luc65r/ing1-gi-groupe-09](https://hub.docker.com/r/luc65r/ing1-gi-groupe-09)

Pour le lancer :
```
docker run --rm -t -p 9000:80 luc65r/ing1-gi-groupe-09:latest
```

Le site se trouve à l'adresse `localhost:9000`.
- Courriel : admin@example.org
- Mot de passe : admin
