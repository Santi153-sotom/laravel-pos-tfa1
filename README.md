# POS Accounts — Laravel TFA1

A four-page POS account directory built with Laravel. The customer and user pages read temporary sample records from PHP arrays in their controllers. SQLite migrations and seeders are included as the database export/setup files requested for submission; they are separate from the page data source.

## Requirements

- PHP 8.2 or newer with the SQLite PHP extension enabled
- Composer

## Run locally

From this project folder, run these commands in PowerShell on Windows:

```bash
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -Path database/database.sqlite -ItemType File -Force
php artisan migrate --seed
php artisan serve
```

Open `http://127.0.0.1:8000`.

On macOS or Linux, use `cp .env.example .env` and `touch database/database.sqlite` for the two file-creation commands.

The pages are `/`, `/about`, `/customers`, and `/users`. The top navigation links to all four.

## Database setup files

- `database/migrations/` creates the `customers` and `users` tables.
- `database/seeders/` inserts five sample customer records and five sample user records.
- The web pages continue to use the static arrays in `CustomerController` and `UserController`, as required by the activity.

## Submission links

After pushing the project to GitHub and deploying it, add the repository URL and hosted application URL to your submission form.
