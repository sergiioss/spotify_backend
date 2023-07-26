<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return 'Bienvenid@ Spotify Music.';
});

/* --------------------- AuthController -------------------- */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(["middleware" => "jwt.auth"], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/updateduser', [AuthController::class, 'updatedUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

