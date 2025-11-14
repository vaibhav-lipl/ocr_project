# OCR Project – Laravel 12 Application

This is a Laravel 12 project built with a modular structure that includes authentication, user management, responsive admin layout, and Sanctum-based API authentication.

## Installation

Clone the repository:

```bash
git clone https://github.com/vaibhav-lipl/ocr_project.git
cd ocr-project
```

Install dependencies:

```bash
composer install
```

Copy the example environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

## Configuration

Update `.env` with your database configuration:

```
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run the database migrations:

```bash
php artisan migrate
```

Run the seeders (creates roles and an admin user):

```bash
php artisan db:seed --class=RolesAndAdminSeeder
```

## Authentication

The application uses:

- Laravel’s built-in web authentication (login/register)
- Sanctum for API token authentication

## Project Structure

Key features included:

- Responsive admin layout with collapsible sidebar
- User module (CRUD) with DataTables
- Export user list to Excel & PDF
- SweetAlert toast notifications
- Role & Permission management
- API login / profile / logout via Sanctum

## Running the Application

Start the development server:

```bash
php artisan serve
```

Visit in browser:

```
http://127.0.0.1:8000
```

## Default Admin Credentials

Created by the seeder:

```
Email: admin@example.com
Password: admin123
```

## API Endpoints

Authentication endpoints are prefixed with `/api`.

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/login` | Generate Sanctum token |
| POST | `/api/logout` | Revoke token |
| GET | `/api/profile` | Get authenticated user |

Use the token in headers:

```
Authorization: Bearer <token>
```

## Testing

```bash
php artisan test
```

## License

This project is open-sourced under the MIT License.
