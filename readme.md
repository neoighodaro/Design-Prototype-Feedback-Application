# Example on how to build a realtime design prototype feedback app using Vue, Pusher and Laravel
[![Get help on Codementor](https://cdn.codementor.io/badges/get_help_github.svg)](https://www.codementor.io/neoighodaro?utm_source=github&utm_medium=button&utm_term=neoighodaro&utm_campaign=github)

![](https://www.dropbox.com/s/v57xcp41uqoyzro/Create-a-realtime-design-feedback-app-using-VueJS-Pusher-and-Laravel.gif?raw=1)

-----

### Requirements
For this to work, you need to have


- Knowledge of PHP & the [Laravel](https://laravel.com) framework.
- Knowledge of JavaScript (ES6).
- Knowledge of VueJS.
- PHP 7.0+ installed locally on your machine.
- [Laravel CLI](https://laravel.com/docs/5.5/installation#installing-laravel) installed locally.
- [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) installed locally.
- [NPM](https://docs.npmjs.com/cli/install) and NodeJS installed locally.
- A Pusher application. Create one on [pusher.com](https://pusher.com).

The code is available on the [Pusher](https://blog.pusher.com/author/neo) blog.

### Installation
* Download or clone the repository.
* Copy the `.env.example` file to `.env`.
* In your `.env` file
    * Change the `DB_CONNECTION=sqlite`
    * Remove all other `DB_*` keys.
    * Change `BROADCAST_DRIVER=pusher`.
    * Update the `PUSHER_APP_*` keys with the values from the Pusher dashboard.
    * Add `PUSHER_APP_CLUSTER="CLUSTER"` where `CLUSTER` is the Pusher application cluster.
* Run `php artisan key:generate` to generate the key for the env file.
* Run `touch databases/database.sqlite` to create the SQLite database file.
* Run `php artisan migate` to migrate the databases.
* Update the `resources/assets/js/bootstrap.js` file with the Pusher key.
* Run `npm install` to install the dependencies.
* Run `npm run dev` to run the NPM script.
* Run `php artisan serve`.
