use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
   Route::post('register', [AuthController::class, 'register']);
   Route::post('login', [AuthController::class, 'login']);
   Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
   Route::middleware('auth:sanctum')->group(function () {
       Route::post('posts', [PostController::class, 'store']);
       Route::put('posts/{id}', [PostController::class, 'update']);
       Route::delete('posts/{id}', [PostController::class, 'destroy']);
   });

   Route::get('posts', [PostController::class, 'index']);
   Route::get('posts/{id}', [PostController::class, 'show']);