# M & E

## Installing Instructions:

* Clone the repo:
    -- `git clone {ssh/https}`

* `cd M_AND_E`

* `composer install`

* Create the `.env` file from `.env.example` and insert the essential data

* `php artisan key:generate`

* `php artisan migrate`

* `npm install`

* `php artisan serve`

## Generate jwt secret key by

* `php artisan jwt:secret`

## Development Purpose

* `npm run dev` OR `npm run watch`

That's it !
