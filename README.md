# S3 upload app

Minimal Laravel app with registration, login, and private per-user S3 uploads/downloads.

## Setup

1. Copy `.env.example` to `.env`.
2. Set `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, and `AWS_BUCKET`.
3. Run:

```bash
composer install
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate
php artisan serve
```

The app uses Blade and has no frontend build step. Uploads are limited to 10 MB and validated by type. Keep the S3 bucket private.
