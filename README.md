# Laravel User CRUD Project

This is a Laravel application with User CRUD, Authentication (Breeze), and a Sidebar layout.

## Getting Started

To run this project locally, follow these steps:

1. **Install Dependencies** (if you haven't already):
    ```bash
    composer install
    npm install
    ```

2. **Setup Environment**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    touch database/database.sqlite
    php artisan migrate
    ```

3. **Run Development Server**:
    You need to run two commands in separate terminal windows:

    **Terminal 1** (Laravel Server):
    ```bash
    php artisan serve
    ```

    **Terminal 2** (Vite Asset Compilation):
    ```bash
    npm run dev
    ```

4. **Access the App**:
    Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

## Features

- **Authentication**: Login, Register, Logout (Laravel Breeze).
- **Sidebar Layout**: Custom dashboard with sidebar navigation.
- **User CRUD**: Manage users (Create, Read, Update, Delete) via the "Users" menu.

## Verification

You can run the automated tests to verify functionality:

```bash
php artisan test
```
