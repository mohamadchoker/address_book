## Requirements

* PHP >= 7.2.5
* Database MySQL 5.7
* Web Server (eg: Apache, Nginx)

## Framework

AddressBook uses [Laravel 7](http://laravel.com), the best existing PHP framework

## Installation

* Install [Composer](https://getcomposer.org/download) and [Npm](https://nodejs.org/en/download)
* Clone the repository: `git clone https://github.com/mohamadchoker/address_book.git`
* Install dependencies: `composer install ; npm install ; npm run dev`
* Create .env file: `cp .env.example`
* Create application key: `php artisan key:gen`
* Migration: `php artisan migrate`
* Required data seeding: `php artisan db:seed`
* Create public disk symbolik link: `php artisan storage:link`
* Composer dump: `composer dump`

## Testing
* `php artisan test`
or
* `vendor/bin/phpunit`
