# Laravel 11 Project Skeleton with RSI Pattern

## Project Description

This project is a Laravel version 11 application built using the Repository Service Interface (RSI) pattern. The RSI pattern separates the business logic of the application from data access into repositories, integrating them with services to perform business operations. This approach makes the application more modular, testable, and maintainable.

## Key Features

-   **Repository Pattern**: Provides an abstraction for data access, decoupling business logic from storage implementation details.
-   **Service Pattern**: Implements business rules and uses repositories for data access and manipulation.
-   **Interface Pattern**: Utilizes interfaces to define contracts for operations that implementing classes must adhere to.

## Installation

### System Requirements

-   PHP >= 8.4
-   Composer

### Installation Steps

1. **Clone the Repository**

    ```bash
    git clone https://github.com/your-account/repository-service-interface-laravel.git
    cd repository-service-interface-laravel
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Configure Environment**
   Copy the .env.example file to .env and configure the database and other settings.

    ```bash
    cp .env.example .env
    ```

4. **Generate App Key**
   After configuring, generate an application key:

    ```bash
    php artisan key:generate
    ```

5. **Run Database Migration**
   Run migrations to create necessary database tables:

    ```bash
    php artisan migrate
    ```

6. **Run The Application**
   Finally, start the Laravel application:

    ```bash
    php artisan serve
    ```

    The application will run at http://localhost:8000.

### License

This project is licensed under the MIT License. See the LICENSE file for more information.
