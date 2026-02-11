


# Salla Custom Box – Laravel Starter Kit

This repository contains the initial implementation of the Custom Box Builder for Salla, built using Laravel.

##  Project Overview

This is an evolving project focusing on:

* **Laravel Application Architecture**: Robust backend setup using the Salla Starter Kit.
* **Database Integration**: MySQL-driven product and user management.
* **Product Synchronization**: Automated fetching of store items via the Salla API.
* **Box Builder Interface**: A custom tool for creating product packages.

---

##  Project Requirements

Ensure your local environment meets these specifications:

* **PHP**: 8.1 or higher
* **Package Managers**: Composer & npm
* **Database**: MySQL
* **Tools**: Git

---

## Local Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/Esraaaak/Salla-Custom-Box.git
cd Salla-Custom-Box

```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build

```

### 3. Configure Environment

Create your local environment file:

```bash
cp .env.example .env
php artisan key:generate

```

**Edit `.env` and configure your database settings:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=salla_app
DB_USERNAME=root
DB_PASSWORD=your_password

```

### 4. Database Setup

Initialize the database schema. This step is mandatory to create the `users` and `products` tables:

```bash
php artisan migrate

```

### 5. Synchronizing Products from Salla

Pull your store's products into the local database to populate the builder dropdowns:

```bash
php artisan app:sync-products

```

*When prompted, type **yes** and hit Enter.*

### 6. Running the Application

Start the local development server:

```bash
php artisan serve

```

Access the application at: `http://127.0.0.1:8000`

---

## Troubleshooting & Usage Notes

### Accessing the Box Builder

1. Visit `http://127.0.0.1:8000` and click **"LogIn"** to authenticate.
2. The application is configured to redirect you to the builder automatically.
3. Direct Link: `http://127.0.0.1:8000/box_builder.html`.

### Common Issues

* **Redirect/Login Issues**: Open Browser Inspector -> Storage -> Cookies. Delete `salla_demo_app_session` for `127.0.0.1` and refresh the page.
* **Empty Product Lists**: Verify that `php artisan app:sync-products` completed successfully.
* **Database Errors**: Ensure your MySQL server is running and the `DB_DATABASE` name in `.env` matches your local database.

---

### Current Technology Stack

* **Framework**: Laravel 10+
* **Database**: MySQL
* **Integration**: Salla API
* **Frontend**: Custom Box Builder Interface (HTML/JavaScript)

