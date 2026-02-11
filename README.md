**Salla Custom Box – Laravel Starter Kit**

This repository contains the initial implementation of the Custom Box Builder for Salla, built using Laravel.

This is an evolving project. The current version focuses on:
	•	Laravel application setup
	•	MySQL database integration
	•	Synchronization of products from the Salla store
	•	Basic Box Builder functionality

Additional modules and features will be added as the project develops.

⸻

Project Requirements

Before running the project, ensure you have:
	•	PHP 8 or higher
	•	Composer
	•	Node.js and npm
	•	MySQL
	•	Git

⸻

Local Setup Instructions

1. Clone the repository

git clone https://github.com/Esraaaak/Salla-Custom-Box.git
cd Salla-Custom-Box

2. Install dependencies

Install PHP and JavaScript dependencies:

composer install
npm install && npm run build

3. Configure the environment

Copy the environment example file and generate the application key:

cp .env.example .env
php artisan key:generate

Open the .env file and configure your local database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=salla_app
DB_USERNAME=root
DB_PASSWORD=your_password

Ensure MySQL is running before proceeding.

⸻

Database Setup

Run the migrations to create the required tables:

php artisan migrate


⸻

Synchronizing Products from Salla

The following command pulls products from the Salla store into your local database. These products are used in the Box Builder interface.

php artisan app:sync-products

If prompted, confirm by typing yes.
⸻

Running the Application

Start the Laravel development server:

php artisan serve

Open the application in your browser:

http://127.0.0.1:8000

Click Get Access Token to log in.

Note: To open the Box Builder page directly, use the following URL:

http://127.0.0.1:8000/box_builder.html


⸻

Troubleshooting

Redirect issues or incorrect page after login

Clear browser cookies for 127.0.0.1 and refresh the page.

Products not appearing in the builder

Ensure that:
	•	You ran php artisan app:sync-products
	•	Laravel is running on port 8000
	•	Your database connection is correctly configured in .env

⸻

Current Technology Stack
	•	Laravel
	•	MySQL
	•	Salla API integration
	•	Custom Box Builder interface

⸻
