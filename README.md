# Register — Registration Form

A Laravel-based registration form with server-side validation, duplicate-data prevention, and request throttling.

## Features

- Registration form with six fields:
    - First name
    - Last name
    - Mobile number
    - Email address
    - Date of birth
    - Iranian national ID
- Server-side validation using Laravel Form Requests.
- Custom Iranian national ID validation.
- Unique mobile number, email address, and national ID.
- Persian validation and success messages.
- CSRF protection.
- Request throttling on form submissions (`5 requests per minute`).
- Responsive interface built with Blade and Tailwind CSS.

## Requirements

- PHP 8.3 or a compatible version satisfying `composer.json`
- Composer
- Node.js and npm
- MySQL or MariaDB

## Installation

Clone or copy the project, then run:

```bash
composer install
npm install
```

Create your local environment file:

```bash
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, if needed, use:

```powershell
Copy-Item .env.example .env
```

Configure the database settings in `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=register_db
DB_USERNAME=root
DB_PASSWORD=
```

Create the `register_db` database in MySQL/MariaDB, then run the migrations:

```bash
php artisan migrate
```

Build the front-end assets:

```bash
npm run build
```

## Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open the registration form at:

`http://127.0.0.1:8000/register`

For front-end development with Vite, run this in a separate terminal:

```bash
npm run dev
```

## Validation and Security

- Registration data is validated on the server.
- Mobile numbers must match the Iranian mobile-number format configured by the application.
- National IDs are checked using a custom validation rule.
- Duplicate mobile numbers, email addresses, and national IDs are rejected.
- The registration POST route uses Laravel's `web` middleware and `throttle:5,1`.
- CSRF protection is provided by Laravel's web middleware.

## Tests

Run the automated test suite:

```bash
php artisan test
```

## Notes

- Keep `.env` private; do not commit credentials.
- Set `APP_DEBUG=false` in production.
- The default Laravel migrations for users, cache, and jobs may remain pending if they are not required by this project.
