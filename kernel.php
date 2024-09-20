### Step 1: Install Laravel

1. Open a terminal and navigate to the directory where you want to create your Laravel project.
2. Run the following command to create a new Laravel project:

   ```bash
   composer create-project --prefer-dist laravel/laravel blog-api
   ```

   This will create a new folder called `blog-api` containing your Laravel application.

3. Navigate into the project directory:

   ```bash
   cd blog-api
   ```

### Step 2: Install Laravel Sanctum for JWT Authentication

We will use Laravel Sanctum for token-based authentication:

1. Install Sanctum via Composer:

   ```bash
   composer require laravel/sanctum
   ```

2. Publish Sanctum’s configuration file:

   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   ```

3. Run the migration to create the necessary tables for Sanctum:

   ```bash
   php artisan migrate
   ```

4. Add the Sanctum middleware in `app/Http/Kernel.php`. Under the `api` middleware group, add `\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class`:

   ```php
   'api' => [
       \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
       'throttle:api',
       \Illuminate\Routing\Middleware\SubstituteBindings::class,
   ],
   ```

### Step 3: Set Up User Authentication (Register & Login)

1. Create a new **AuthController**:

   ```bash
   php artisan make:controller AuthController
   ```

### Step 4: Create Blog Post Model, Controller, and Routes

Now we’ll add functionality for creating and managing blog posts.

1. Create the Post model and migration:

   ```bash
   php artisan make:model Post -m
   ```

2.   Run the migration:

   ```bash
   php artisan migrate
   ```

3. Create the PostController to handle post-related requests:

   ```bash
   php artisan make:controller PostController
   ```

### Step 5: Test Your API with Postman

Now you can test the Blog API in **Postman**:

1. **Register a User** (POST):  
   - URL: `http://127.0.0.1:8000/api/register`  
   - Body (Raw > JSON):
     ```json
     {
         "name": "John Doe",
         "email": "john@example.com",
         "password": "password",
         "password_confirmation": "password"
     }
     ```

2. **Login a User** (POST):  
   - URL: `http://127.0.0.1:8000/api/login`  
   - Body (Raw > JSON):
     ```json
     {
         "email": "john@example.com",
         "password": "password"
     }
     ```

3. **Create a Post** (POST):  
   - URL: `http://127.0.0.1:8000/api/posts`  
   - Headers: `Authorization: Bearer your_jwt_token`
   - Body (Raw > JSON):
     ```json
     {
         "title": "First Post",
         "body": "This is the content of the first post."
     }
     ```