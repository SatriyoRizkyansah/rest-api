<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Middleware\PemilikPostingan;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\PemilikKomentar;


Route::get('/posts', [PostController::class, 'index']);