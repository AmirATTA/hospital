@echo off

IF "%1" == "s" (
    echo Starting Laravel Project...
    php artisan serve
)

IF "%1" == "m" (
    echo Running Database Migrations...
    php artisan migrate:fresh --seed
)

IF "%1" == "c" (
    echo Creating Controller...
    php artisan make:controller %2
)

IF "%1" == "r" (
    echo Creating Request...
    php artisan make:request %2
)