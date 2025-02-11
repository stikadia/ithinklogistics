# iThinkLogistics

This repository contains the iThinkLogistics project. Follow the steps below to set up the project, configure the database, run migrations, seed data, and perform unit testing.

---

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/stikadia/ithinklogistics.git
   ```

2. Navigate to the project directory:

   ```bash
   cd ithinklogistics
   ```

3. Copy the testing environment file to the main `.env` file:

   ```bash
   cp .env.testing .env
   ```

---

## Database Configuration

Update the following database details in the `.env` file for the main database:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ithinklogistics
DB_USERNAME=ithinklogistics
DB_PASSWORD=ithinklogistics
```

Update the following database details in the `.env.testing` file for the test database:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ithinklogistics_test
DB_USERNAME=ithinklogistics
DB_PASSWORD=ithinklogistics
```

---

## Running Migrations and Seeding Data

1. Run the migration to set up the database schema:

   ```bash
   php artisan migrate
   ```

2. Seed the database with dummy data for categories and products:

   ```bash
   php artisan db:seed
   ```

---

## API Documentation

Refer to the `API.html` file for details on available APIs for categories and products.

---

## Unit Testing

1. Migrate the test database:

   ```bash
   php artisan migrate --env=testing
   ```

2. Run unit tests:

   ```bash
   php artisan test
   ```

---

## Notes

- Ensure that you have `PHP`, `Composer`, and `MySQL` installed and configured properly before proceeding.
- If needed, update the database credentials to match your local environment.
- Run `php artisan serve` to start the application and test APIs manually.

---

Happy coding! 🚀

