# Curtain Call

A Laravel project to manage theatre plays.

## Table of contents

- [About](#about)
  - [Admin panel](#admin-panel)
  - [Client side](#client-side)
- [Project requirements](#project-requirements)
- [Project setup](#project-setup)
  - [Configure the `.env` file](#configure-the-env-file)
  - [Download assets and migrate and seed the database](#download-assets-and-migrate-and-seed-the-database)

## About

Curtain Call is a project about managing theater plays.

### Admin panel

Admins can login at the specific route `/admin/login`. They can manage all the entities (theater performances, theaters, cities, ticket types). There currently 2 roles that can be managed:

- `admin` - can perform CRUD operations on the entities
- `superadmin` - same as the above + admin creation and role management

> **NOTE:** The first user is seeded as `superadmin` and you can configure it in the `.env` file. [Configure the `.env` file](#configure-the-env-file)

### Client side

The client side consists of a homepage, performance list and performance details. The homepage displays the latest upcoming performances. It also has a performance search bar by performance name, theater and filter by dates. The performance list is a paginated list of all (or filtered) performances. The performance details shows a detailed view of an performance entity alongside with ticket details.

## Project requirements

This project was initialized using the following dependencies:

- php 8
- composer
- Laravel 9
- Backpack for Laravel

## Project setup

### Configure the `.env` file

You can get the app to be fully operational by copying the contents of the `.env.example` into `.env` file and then doing the following operations:

Variables to be modified:

    APP_URL=

    DB_DATABASE_NAME=

> **NOTE:** `APP_URL` depends on the way you host the app and/if you have virtualhost configurations. Usually `http://localhost`

> **NOTE:** It might be a good idea to add different database name instead of `laravel`

Variables to be set:

    SCOUT_DRIVER=database
    
    SUPERADMIN_NAME=
    SUPERADMIN_EMAIL=
    SUPERADMIN_PASSWORD=
    
    BACKPACK_REGISTRATION_OPEN=false

> **NOTE:** The fields `SUPERADMIN_NAME`, `SUPERADMIN_EMAIL` and `SUPERADMIN_PASSWORD` can be entirely customized. If you run the seed without them it will default to `SUPERADMIN_NAME=test`, `SUPERADMIN_EMAIL=test@test.com` and `SUPERADMIN_PASSWORD=123123`. **PLEASE BE WARNED THAT THIS IS NOT RECCOMENDED IN A PRODUCTION ENVIRONMENT!**


### Download assets and migrate and seed the database
In order for the project to be fully operational you have to run these commands inside the project folder

    composer install
    php artisan key:generate
    php artisan backpack:publish-assets
    php artisan migrate --seed
