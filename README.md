# Utakeep
Utakeep is a Laravel application for tracking and sharing your karaoke repertoire.

You can organize songs by status, follow other users, and browse karaoke activity in a timeline. Song search is powered by the iTunes Search API.

## Tech Stack
- PHP 8.2+
- Laravel 12
- Laravel Fortify
- Livewire 3
- MySQL
- Tailwind CSS 4
- Vite
- Laravel Sail

## Setup
### Laravel Sail
If you use Docker, you can run the app with Laravel Sail.

```bash
composer install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### Local
If PHP, Composer, Node.js, and MySQL are installed locally, you can run the app without Sail.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
composer run dev
```
