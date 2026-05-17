# School Management System API

A production-grade RESTful API built with **Laravel 11** for managing a complete school environment — students, teachers, courses, enrollment, attendance, and grading — with a fully layered clean architecture.

---

## Features

- **Role-Based Authentication** — Admin and Student roles with separate route groups, secured via Laravel Sanctum token authentication and custom middleware (`IsAdmin`, `IsStudent`)
- **Course Management** — Full CRUD for courses, with admin-only creation and student enrollment workflows
- **Enrollment System** — Students enroll in courses; admins manage and review enrollments
- **Attendance Tracking** — Record and query attendance per course session using type-safe `AttendanceStatus` Enum
- **Grading System** — Admins assign and update grades per student per course
- **Student Status Management** — Tracked via `StudentStatus` Enum for consistent state handling across the system
- **Standardised API Responses** — All endpoints return a unified JSON structure via a shared `ApiResponse` trait, including paginated responses with full metadata

---

## Architecture

The project follows a strict layered architecture to keep the codebase clean, testable, and maintainable:

```
app/
├── Http/
│   ├── Controllers/Api/
│   │   ├── Admin/          # Admin-facing endpoints (thin controllers only)
│   │   ├── Student/        # Student-facing endpoints
│   │   └── Auth/           # Login, logout, registration
│   ├── Requests/           # Form Request validation & authorisation per resource
│   └── Middleware/
│       ├── IsAdmin.php
│       └── IsStudent.php
├── Models/                 # Eloquent models & relationships
├── Services/               # Business logic layer — all domain rules live here
├── Contracts/
│   ├── *.php               # Repository interfaces (contracts)
│   └── Implementations/    # Concrete repository implementations
├── Enums/
│   ├── AttendanceStatus.php
│   └── StudentStatus.php
└── Traits/
    └── ApiResponse.php     # Unified JSON response format
```

**Layer responsibilities:**
- **Controllers** — Handle HTTP only. No business logic, no direct DB calls.
- **Form Requests** — Validate input and authorise the action before it reaches the controller.
- **Services** — Own all business logic. Called by controllers, call repositories.
- **Repositories** — Own all database operations. Eloquent is never touched directly in services.
- **Enums** — Enforce type-safe state representation across the application.

---

## API Response Format

All endpoints return a consistent JSON structure:

```json
// Success with data
{
  "code": 200,
  "message": "Student retrieved successfully",
  "data": { "id": 1, "name": "Ahmed" }
}

// Success with pagination
{
  "code": 200,
  "message": "Students retrieved successfully",
  "data": [...],
  "meta": {
    "current_page": 1,
    "per_page": 15,
    "last_page": 3,
    "total": 40,
    "next_page_url": "...",
    "prev_page_url": null
  }
}

// Error
{
  "code": 404,
  "message": "Student not found"
}
```

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 11 |
| Database | MySQL |
| Authentication | Laravel Sanctum |
| Architecture | Service + Repository Pattern |
| Type Safety | PHP Enums |
| Testing | PHPUnit |

---

## Getting Started

```bash
# 1. Clone the repository
git clone https://github.com/mahmoudharedii22-prog/school-management-system-api.git
cd school-management-system-api

# 2. Install dependencies
composer install

# 3. Set up environment
cp .env.example .env
php artisan key:generate

# 4. Configure your database in .env
# DB_DATABASE=school_management
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Run migrations and seed
php artisan migrate
php artisan db:seed

# 6. Start the server
php artisan serve
```

**Seed creates test users:**
```bash
php artisan tinker
User::factory()->count(5)->create();             # regular students
User::factory()->createAdmin()->count(2)->create(); # admin users
```

---

## Authentication

All protected routes require a Bearer token obtained from the login endpoint.

```
POST /api/auth/login
POST /api/auth/register
POST /api/auth/logout       # requires token

# Admin routes
GET  /api/admin/students
POST /api/admin/courses
...

# Student routes
GET  /api/student/courses
POST /api/student/enroll
...
```

---

## Author

**Mahmoud Sayed Ali Harredy**
[LinkedIn](https://www.linkedin.com/in/mahmoud-haredi) · [GitHub](https://github.com/mahmoudharedii22-prog)
