- [Описание проекта](#Описание-проекта)
- [Cтек](#Cтек)
    - [Backend](#Backend)
    - [Frontend](#Frontend)
- [Подготовка](#Подготовка)
- [Пример](#Пример)

# Описание проекта

 <p>Dashboard (AdminLTE) для каталога сотрудников компании (50К).</p>
 <p>Laravel CRUD + JQuery + Ajax + Datatables</p>

## Cтек

* [Laravel](https://github.com/laravel/laravel)
* [JQuery](https://github.com/jquery/jquery)
* [Bootstrap](https://github.com/twbs/bootstrap)

### Backend

* [lazychaser/laravel-nestedset](https://github.com/lazychaser/laravel-nestedset) -  Nested sets or Nested Set Model is a way to effectively store hierarchical data in a relational table.
* [fzaninotto/faker](https://github.com/fzaninotto/Faker) - Faker is a PHP library that generates fake data for you.
* [jeroennoten/Laravel-AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE) - Easy AdminLTE integration with Laravel.
* [yajra/laravel-datatables](https://github.com/yajra/laravel-datatables) - jQuery DataTables API for Laravel 4|5.

### Frontend
* [moment.js](https://github.com/moment/moment) - A lightweight JavaScript date library for parsing, validating, manipulating, and formatting dates.
* [Bootstrap 3 Typeahead](https://github.com/bassjobsen/Bootstrap-3-Typeahead) - The Typeahead plugin from Twitter's Bootstrap 2 ready to use with Bootstrap 3 and Bootstrap 4.
* [bootstrap-datepicker](https://bootstrap-datepicker.readthedocs.io/en/latest/) - Bootstrap-datepicker provides a flexible datepicker widget in the Bootstrap style.
* [datatables](https://datatables.net/) - DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table.
* [inputmask](https://github.com/RobinHerbots/Inputmask) - Inputmask is a javascript library which creates an input mask. Inputmask can run against vanilla javascript, jQuery and jqlite.
* [select2](https://select2.org/) - Select2 gives you a customizable select box with support for searching, tagging, remote data sets, infinite scrolling, and many other highly used options.

## Подготовка

* git clone or download zip
* edit .env
* composer install
* npm install
* npm run dev | npm run build
* php artisan migrate
* php artisan db:seed

В ENV доп 3 параметра для заполнения бд:

* SEED_EMP_COUNT=50000 // Кол-во сотрудников, для проверки лучше 1000 - быстрее заполнится
* SEED_DIR_COUNT=1 // Кол-во директоров (root node)
* SEED_DEPTH_TREE=5 // Глубина дерева, кол-во уровней

## Пример
test account:

user: test@test.com

pass: password

[Пример](https://laracrudapppp.000webhostapp.com/)

