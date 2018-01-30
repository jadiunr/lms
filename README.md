# LMS

Learning Management System

# Getting Started

```
cp .env.example .env
//vim .env
  
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
```

Default Accounts  

```
admin@example.jp //Admin
[1-15]@example.jp //User
```