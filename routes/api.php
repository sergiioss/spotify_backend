<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongsController;
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
    return 'Bienvenid@ a Spotify Music';
});

/* --------------------- Auth Controller -------------------- */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(["middleware" => "jwt.auth"], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/updateduser', [AuthController::class, 'updatedUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

/* ------------------- Users Controller ------------------ */

Route::group(["middleware" => ["jwt.auth", "isMaster"]], function () {
    /* ------------------------- ADMIN ---------------------- */
    Route::post('/user/add_admin/{id}', [UserController::class, 'rolAdmin']);
    Route::delete('/user/delete_admin/{id}', [UserController::class, 'deleteRolAdmin']);
    /* ---------------------- SUPER ADMIN -------------------- */
    Route::post('/user/super_admin/{id}', [UserController::class, 'rolSuperAdmin']);
    Route::delete('/user/delete_super_admin/{id}', [UserController::class, 'deleteRolSuperAdmin']);
});

/* --------------------- Artists Controller -------------------- */

Route::get('/artists-all', [ArtistController::class, 'artistAll']);
Route::group(["middleware" => "isAdmin"], function () {
    Route::post('/create-artist',[ArtistController::class, 'createArtist']);
    Route::put('/updated-artist/{id}', [ArtistController::class, 'updatedArtist']);
    Route::delete('/delete-artist/{id}', [ArtistController::class, 'deleteArtist']);
});

/* --------------------- Albums Controller -------------------- */

Route::group(["middleware" => "isAdmin"], function () {
    Route::post('/create-album',[AlbumsController::class, 'createAlbum']);
    Route::put('/updated-album/{id}',[AlbumsController::class, 'updatedAlbum']);
    Route::post('/delete-album/{id}',[AlbumsController::class, 'deleteAlbum']);
    Route::get('/show-albums',[AlbumsController::class, 'showAlbums']);
});

/* --------------------- Songs Controller -------------------- */

Route::group(["middleware" => "isAdmin"], function () {
    Route::post('/create-song',[SongsController::class, 'createSong']);
   /*  Route::put('/updated-album/{id}',[AlbumsController::class, 'updatedAlbum']);
    Route::post('/delete-album/{id}',[AlbumsController::class, 'deleteAlbum']);
    Route::get('/show-albums',[AlbumsController::class, 'showAlbums']); */
});