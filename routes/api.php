<?php

use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\StudentController;

// ==================
// USER AUTHENTICATION ROUTES
// ==================

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return ResponseHelper::responseFormat(Response::HTTP_FORBIDDEN, 'Unauthorized');
})->name('login');

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// ==================
// STUDENT ROUTES
// ==================
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'students'], function () {
    Route::get('/search', [StudentController::class, 'search'])->name('students.search');
    Route::get('/', [StudentController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{id}', [StudentController::class, 'show']);
    Route::post('/', [StudentController::class, 'store']);
    Route::put('/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'destroy']);

});
