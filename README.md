🚀 OCR Project – Laravel 12 (Bootstrap + Sanctum + Roles & Permissions)

This project is a Laravel-based web application that includes:

User authentication system

Role & Permission management

Manage Users module (CRUD, DataTable, Export Excel/PDF)

Responsive admin layout with sidebar

SweetAlert notifications

Sanctum API authentication

Dashboard with analytics cards

This document explains how to fully set up the project after cloning from Git.

🛠 1. System Requirements

Before starting, ensure your system has:

PHP 8.2+ (Recommended: PHP 8.3 / 8.4)

Composer v2+

MySQL or MariaDB

Apache/Nginx

Node.js (Not required for this project)

Git

📥 2. Clone the Repository
git clone https://github.com/your-repo/ocr_project.git
cd ocr_project

⚙️ 3. Install PHP Dependencies
composer install


This installs Laravel and all required packages:

Sanctum

Spatie Roles & Permissions

DataTables

Excel export (maatwebsite/excel)

PDF export (dompdf)

📄 4. Create Environment File

Copy .env.example to .env:

cp .env.example .env

🗝 5. Generate Application Key
php artisan key:generate

🗄 6. Configure Database

Open .env and update these values:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ocr_project
DB_USERNAME=your_username
DB_PASSWORD=your_password

🧱 7. Run Migrations

This will generate all tables:

php artisan migrate

🌱 8. Run Seeder (Admin User + Roles)

If your project includes a seeder such as:

RolesAndAdminSeeder

Run:

php artisan db:seed --class=RolesAndAdminSeeder


This will create:

Default Admin role

One admin user

Default permissions

🔐 9. Sanctum Setup (API Authentication)

Sanctum migration is already included.
Ensure you have this in bootstrap/app.php:

$middleware->appendToGroup('api', [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
]);


API routes are inside:

routes/web.php (api prefix)


Sample endpoints:

Method	Endpoint	Description
POST	/api/login	User Login (Sanctum Token)
POST	/api/logout	Logout
GET	/api/profile	Authenticated User Profile
🎨 10. Frontend Setup

This project uses Bootstrap 5 CDN, so no npm or build tools are required.

Admin layout includes:

Responsive sidebar

Collapsible menu

Mobile menu

Bootstrap icons

SweetAlert toast notifications

📊 11. DataTables, Export Excel & PDF

Included features:

Server-side DataTables

Export to Excel (maatwebsite/excel)

Export to PDF (dompdf)

Responsive table view

Nothing extra to install — already included via Composer.

🔧 12. Fix Public Path Issue (Optional)

If app opens like:

http://localhost/ocr_project/public


Move:

public/index.php → root
public/.htaccess → root


And update paths inside index.php accordingly.

▶️ 13. Run the Application

Start the local server:

php artisan serve


Open in browser:

http://127.0.0.1:8000

👤 14. Default Admin Login (From Seeder)
Email: admin@example.com
Password: admin123


(Change in seeder if needed)

📚 15. Project Features Overview
Authentication

✔ Login / Logout
✔ Registration
✔ Password reset (optional)

User Module

✔ Listing with DataTable
✔ Create, Edit, Delete
✔ Status toggle (Active/Inactive)
✔ Export to Excel & PDF
✔ View user details

Dashboard

✔ Total Users card
✔ Responsive layout

API

✔ Secure login with Sanctum
✔ Token based authentication
✔ Profile & Logout endpoints

🧩 16. Troubleshooting
1. Migration error

→ Check DB credentials in .env

2. 500 error

→ Run:

composer dump-autoload
php artisan optimize:clear

3. Token not working

→ Ensure API requests include Authorization header:

Authorization: Bearer <token>

❤️ 17. Contribution

Feel free to fork, submit PRs, or report issues.

📜 License

This project is open-source and available under the MIT license.