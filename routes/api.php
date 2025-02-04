<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Middleware\PemilikPostingan;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\PemilikKomentar;


// Route::get('/posts', [PostController::class, 'index']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware(PemilikPostingan::class);
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(PemilikPostingan::class);
    
    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware(PemilikKomentar::class);
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware(PemilikKomentar::class);
});


Route::post('/login', [AuthenticationController::class, 'login']);