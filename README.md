## Setup Steps

1. Clone the repository
   git clone <repo-url>

2. Install dependencies
   composer install

3. Copy .env file
   cp .env.example .env

4. Generate application key
   php artisan key:generate

5. Configure database in .env

6. Run migrations
   php artisan migrate

7. (Optional) Seed the database
   php artisan db:seed

8. Run the server
   php artisan serve

## Architecture Explanation


app/
│
├── Http/
│   │
│   ├── Controllers/
│   │   └── Api/
│   │       ├── Admin/
│   │       │   └── (Admin related controllers)
│   │       │
│   │       ├── Student/
│   │       │   └── (Student related controllers)
│   │       │
│   │       └── Auth/
│   │           └── (Authentication controllers: login, logout, etc.)
│   │
│   ├── Requests/
│   │   ├── Attendance/
│   │   ├── Enrollment/
│   │   ├── Course/
│   │   ├── Grade/
│   │   ├── Student/
│   │   └── Auth/
│   │       └── (Authentication related requests)
│   │
│   └── Middleware/
│       ├── IsAdmin.php
│       └── IsStudent.php
│
├── Models/
│   └── (Eloquent models & relationships)
│
├── Services/
│   └── (Business logic layer)
│
├── Contracts/
│   ├── (Repository interfaces)
│   │
│   └── Implementations/
│       └── (Repository implementations)
│
├── Enums/
│   ├── AttendanceStatus.php
│   └── StudentStatus.php
│
└── Traits/
    └── (Reusable shared logic)


The project follows a layered architecture to keep the code clean and maintainable.

- Controllers(thin):
  Handle HTTP requests and responses only, without business logic.

- Form Requests:
  Responsible for request validation and authorization.


- Enums
  Enums are used to represent fixed states across the application in a type-safe way.

- Services:
  contain the business logic of the application, They act as an intermediate layer between controllers and repositories.

  
- Repositories:
  Repositories are responsible for handling all database operations, They abstract the data access layer and prevent direct interaction with Eloquent models inside services.


- Models:
  Represent database entities and handle relationships.

- Traits:
  Used for reusable logic such as standard API responses.

- Routes:
  API routes are grouped by version and role (admin) for better scalability.

  
## Response Standard Explanation

All API responses in the application follow a consistent and unified structure using the ApiResponse trait. This ensures that all endpoints return responses in the same format, making it easier for frontend and mobile clients to consume the API reliably.

- Success Responses
  Indicate successful operations.

  (1) Success without data to show
  
  {
  "code": 200,
  "message": "Student retrieved successfully",
}

  (2) Success with data to show

{
  "code": 200,
  "message": "Student retrieved successfully",
  "data": {
    "id": 1,
    "name": "Ahmed"
  }
}

(3) Success with pagination 

{
  "code": 200,
  "message": "Student retrieved successfully",
  "data": {
    "id": 1,
    "name": "Ahmed"
  }
   "meta": {
    "current_page": 1,
    "per_page": 15,
    "last_page": 3,
    "total": 40,
    "next_page_url": "...",
    "prev_page_url": null,  
  }
}

(4) Error
{
  "code": 404,
  "message": "Validation failed",
}
