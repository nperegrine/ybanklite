> yBankLite improved Laravel Backend API

## Installation
1.) Install all composer dependencies
```bash
composer install
```
2.) Make sure you have the Laravel .env file in your project root and generate your APP_KEY
```bash
php artisan key:generate
```
3.) Run your database migrations and seed the database
```bash
php artisan migrate
php artisan db:seed
```
4.) You are now ready to launch the yBankLite API
```bash
php artisan serve
```
## Testing
Feature tests are located in the "/tests/feature" directory and Unit tests are located in the "/tests/unit" directory. 
Enter the following command to run PHPUnit tests.
```bash
vendor/bin/phpnunit or php artisan test
```
