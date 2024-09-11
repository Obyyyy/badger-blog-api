# Badger-blog-api - Laravel REST API Project

## What's inside of this repos??

This repository contains the Laravel API project development process, namely a Badger Blog API. This project uses Laravel 11 for development and MySQL as the database. This project uses Sanctum for authentication 

## How can you clone the project??:

You can clone this repository with this methods:

-   HTTPS: Use Git checkout by making use of this URL: https://github.com/Obyyyy/badger-blog-api.git
    ```shell
    git clone https://github.com/Obyyyy/badger-blog-api.git
    ```

## Setup the project
- Run the following commands to setup the project:
    ```sh
    composer install
    ```
    ```sh
    cp .env.example .env
    ```
    ```sh
    php artisan key:generate
    ```

## Setup the Database

-   Start your web server and sql using XAMPP, Laragon, Laravel Herd or etc.
-   Open the repository in VSCode, and run this command in terminal to create the database schema
    ```shell
    php artisan migrate --seed
    ```

## Run the Application
-   Open a another terminal tab, and run `php artisan serve` to run the application

## Test the API using Postman
- Import file *Badger API.postman_collection.json* collection to your postman
- Test sending requests for every endpoint
