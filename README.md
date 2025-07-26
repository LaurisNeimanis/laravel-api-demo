# Laravel API Demo

A minimal Laravel 12 project demonstrating how to build and expose a simple RESTful API endpoint. Perfect for showcasing PHP development skills, API design, database seeding, and automated testing.

## Features

- 🔹 Laravel 12 setup with out-of-the-box configuration
- 🔹 `/api/users` endpoint returning JSON list of users
- 🔹 Eloquent model & resource controller structure
- 🔹 Database seeding with sample data
- 🔹 PHPUnit Feature test for `/api/users`
- 🔹 Simple authentication stub (sanctum/passport can be added)
- 🔹 Clear README for immediate onboarding

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Database: MySQL, MariaDB or SQLite
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/LaurisNeimanis/laravel-api-demo.git
   cd laravel-api-demo
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   # Edit .env to set your DB credentials
   ```

4. **Run migrations & seed database**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

6. **Test the API**  
   Visit: `http://localhost:8000/api/users`  
   You should see a JSON response with sample users.  

   **Example Response:**
   ```json
   {
     "data": [
       {
         "id": 1,
         "name": "Test User",
         "email": "test@example.com"
       },
       {
         "id": 2,
         "name": "Random User 1",
         "email": "user1@example.com"
       }
       // ... more users ...
     ]
   }
   ```

## Testing

We include a PHPUnit Feature test to verify the `/api/users` endpoint returns all seeded users:

1. **Run tests**

   ```bash
   php artisan test --filter=UserApiTest
   ```

   **Expected Output:**
   ```text
   PASS  Tests\Feature\UserApiTest
     ✓ returns all seeded users (4 assertions)

   Tests:    1 passed
   Duration: 0.60s
   ```


2. **Test file**\
   `tests/Feature/UserApiTest.php`:

   ```php
   <?php

   namespace Tests\Feature;

   use Illuminate\Foundation\Testing\RefreshDatabase;
   use Tests\TestCase;

   class UserApiTest extends TestCase
   {
       use RefreshDatabase;

       public function test_returns_all_seeded_users(): void
       {
           // Seed 20 random users + Test User
           $this->seed();

           // Call the endpoint
           $response = $this->getJson('/api/users');

           // Assert correct status and count
           $response->assertStatus(200)
                    ->assertJsonCount(21, 'data')
                    ->assertJsonFragment([
                        'email' => 'test@example.com',
                        'name'  => 'Test User',
                    ]);
       }
   }
   ```

## Project Structure

```
/README.md
bootstrap/
└── app.php
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── UserController.php
│   └── Resources/
│       └── UserResource.php
database/
└── seeders/
    └── DatabaseSeeder.php
routes/
└── api.php
tests/
└── Feature/
    └── UserApiTest.php
```

## Extend & Customize

- Add authentication (Laravel Sanctum or Passport)
- Implement additional endpoints (posts, comments, etc.)
- Integrate request validation & error handling
- Hook up to a front-end client or mobile app

## License

This project is open-source and available under the MIT License.

---

🔗 **Back to portfolio:** [My Portfolio](https://github.com/LaurisNeimanis/my-portfolio)
