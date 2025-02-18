# Student Management System

This is a simple Student Management System built with Laravel 11. It provides functionalities to manage students, including creating, updating, deleting, and searching for students. It also includes authentication using Laravel Sanctum.

## Features
- CRUD operations for managing students
- Search functionality by student name and email
- API development for student management
- Authentication using Laravel Sanctum
- Dynamic course assignment (AJAX)

## Installation

Follow the steps below to set up the project locally:

### Prerequisites
- PHP >= 8.0
- Composer
- Laravel 11
- MySQL or PostgreSQL for the database

### Step 1: Clone the repository

```bash
git clone https://github.com/AyeshDil/Student-management.git
```

### Step 2: Install dependencies
Navigate to the project directory and install the necessary dependencies via Composer:

```bash
cd Student-management
composer install
```

### Step 3: Configure the environment file
Duplicate the .env.example file to create a .env file:

```bash
cp .env.example .env
```

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_management
DB_USERNAME=root
DB_PASSWORD=
```


Make sure to configure other environment settings like the APP_KEY, APP_URL, and SANCTUM settings for authentication.

### Step 4: Generate the application key
```bash
php artisan key:generate
```

### Step 5: Run database migrations
Run the migrations to set up the database schema:

```bash
php artisan migrate
```

### Step 6: Seed the database
You can populate the database with some dummy data using the seeders:

```bash
php artisan db:seed
```


### Step 7: Run the application
Start the development server:

```bash
php artisan serve
```

The application will be available at http://localhost:8000.

### Step 8: Import Postman Collection

You can import the provided Postman collection to test the API endpoints.

```bash
Import the Student-Management-System-Ayesh.postman_collection.json file into Postman.
```

# Routes

## Web Routes:
```bash
GET /students - List all students.
GET /students/{id} - View details of a single student.
GET /students/search - Search students by name or email.
POST /students - Create a new student.
PUT /students/{id} - Update student details.
DELETE /students/{id} - Delete a student.
```

## API Routes:

### Authentication Routes
```bash
POST /api/login: Login to the application and obtain an API token.
POST /api/register: Register a new user.
GET /api/login: Returns a 403 Unauthorized response if a valid token is not provided.
GET /api/user: Fetch the currently authenticated user (Protected Route).
POST /api/logout: Logout the authenticated user (Protected Route).
```

### Student Routes (Protected)
All student-related routes are protected and require authentication with a valid API token (via Laravel Sanctum).

```bash
GET /api/students: List all students.
GET /api/students/{id}: Retrieve a specific student by their ID.
POST /api/students: Create a new student.
PUT /api/students/{id}: Update a students details.
DELETE /api/students/{id}: Delete a student.
```

### Search Routes
```bash
GET /api/students/search: Search students by name or email. You can pass name or email as query parameters to filter the students.
```



## Authentication (API)

This application uses Laravel Sanctum for API authentication. You can obtain an API token by logging in:

### Login (POST /api/login)
To get an API token, send a POST request with the following parameters:
```bash
{
    "email": "test@example.com",
    "password": "password"
}
```

The response will contain the token:

```bash
{
    "token": "your_generated_token"
}
```

You can use this token to authenticate subsequent API requests by passing it in the Authorization header as Bearer {token}.

