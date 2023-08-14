# Installation Guide

Welcome to the installation guide for the bachelor-api. Follow these steps to set up and run the project successfully:

## Prerequisites

Before you proceed, ensure you have the following prerequisites:

-   Node.js and npm (Node Package Manager) installed on your system.
-   Git installed for cloning the repository.
-   PHP 8.1

## Installation Steps

1. **Clone the Repository:** Start by cloning the git repository to your local machine using the following command:

    ```bash
    git clone https://github.com/benjaminvenezia/bachelor-api.git
    ```

2. **Database Setup:**

    - Create a local MYSQL database

3. **Environment Configuration:**

    - Rename the `.env.example` file to `.env` in the root of your project.
    - Open the `.env` file and fill in your database information.

        ```
        DB_HOST=your_database_host
        DB_PORT=your_database_port
        DB_DATABASE=your_database_name
        DB_USERNAME=your_database_username
        DB_PASSWORD=your_database_password
        ```

4. **Install Dependencies:**

    - Open your console and navigate to your project's root directory.
    - Run the following command to install the necessary dependencies:

        ```bash
        npm install
        ```

5. **Generate Application Key:**

    - Run the following command to generate a unique application key:

        ```bash
        npm run key:generate
        ```

6. **Migrate Database:**

    - Run the migrations to set up the database schema:

        ```bash
        npm run migrate
        ```

    - If there are seeders, you can run them using:

        ```bash
        npm run db:seed
        ```

7. **Run the Development Server:**

    - Launch the development server using:

        ```bash
        npm run serve
        ```

    - This will start the development server, and you'll be able to access the app in your browser at the provided local development URL (usually `http://localhost:3000`).

## Additional Commands

-   **Run phpstan Analysis:**

    -   To perform PHPStan static analysis on the app, use:

        ```bash
        ./vendor/bin/phpstan analyse app --memory-limit=999999999999
        ```

    -   Configuration for PHPStan is located in the `phpstan.neon` file.
