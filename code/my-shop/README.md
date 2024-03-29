# MyShop

Simple PHP project for teaching of MVC, DDD, Hexagonal, FP...

## Requirements
- WSL / Linux / macOS
- PHP >= 8.3
- Composer
- Docker

## How-to
1. Run `composer install` to install the dependencies.
2. Run the DB with `make db`.
3. Run the migrations and serve the app with `make serve`.
4. Optionally, instead of populating the DB manually, you can 
run `make init-db` to add some data.
5. Also, you can run `make mysql` to open the mysql console.

## Tips
1. If adding a new namespace to composer, run `composer dump-autoload`
after adding it.