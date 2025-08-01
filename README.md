# Project Installation Guide

This project was developed and tested using:

-   Laravel 12.21
-   MySQL 8.0.42
-   No caching system is used.

---

To ensure smooth setup and operation of this Laravel project, please follow the installation steps below:

1. Open CMD/Terminal and run:

    ```bash
    composer install
    ```

2. Copy `.env.example` and rename it to `.env`

3. Open CMD/Terminal and run:

    ```bash
    php artisan key:generate
    ```

4. Configure your MySQL database connection in the `.env` file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=example_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Once the above steps are completed, proceed with migrating the database (ensure the database is completely empty):

    ```bash
    php artisan migrate:fresh --seed
    ```

    **(\*)** Please wait until the process is completed. Avoid cancelling to ensure the migration and seeding run properly.

    The seeder will generate the following fake data:

    - 1,000 fake authors
    - 3,000 fake book categories
    - 100,000 fake books
    - 500,000 fake ratings

6. Once done, you can start the Laravel web server by running:

    ```bash
    php artisan serve
    ```

7. Access the website at: [http://localhost:8000](http://localhost:8000) (or your defined address)
    - List of books with filters
    - Top 10 most famous authors
    - Rating input
