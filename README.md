# spatie-permissions-demo

This is a simple app to demonstrate implementing the spatie/laravel-permission package to a fresh Laravel app.

Many of the code examples used in this demo also come from the examples in the Spatie package README.


## Creating Your Own Demo
You could create your own  with the following steps:

Initial setup:

```sh
cd ~/Sites
laravel new mypermissionsdemo
cd mypermissionsdemo
git init
git add .
git commit -m "Fresh Laravel Install"

# Environment
cp -n .env.example .env
sed -i '' 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env
sed -i '' 's/DB_DATABASE=/#DB_DATABASE=/' .env
touch database/database.sqlite

# Package
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
git add .
git commit -m "Add Spatie Laravel Permissions package"
php artisan migrate:fresh

# Add `HasRoles` trait to User model
sed -i '' $'s/use HasFactory, Notifiable;/use HasFactory, Notifiable;\\\n    use \\\\Spatie\\\\Permission\\\\Traits\\\\HasRoles;/' app/Models/User.php
sed -i '' $'s/use HasApiTokens, HasFactory, Notifiable;/use HasApiTokens, HasFactory, Notifiable;\\\n    use \\\\Spatie\\\\Permission\\\\Traits\\\\HasRoles;/' app/Models/User.php
git add . && git commit -m "Add HasRoles trait"

# Add Laravel's basic auth scaffolding
composer require laravel/ui --dev
php artisan ui bootstrap --auth
# npm install && npm run prod
git add . && git commit -m "Setup auth scaffold"
```

- Manually update DatabaseSeeder.php to add permissions, roles, and users
- re-migrate and seed the database:
```sh
php artisan migrate:fresh --seed
```

