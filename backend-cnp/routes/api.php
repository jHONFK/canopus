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
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('teste', function () {
    return 'teste';
});
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('image-upload', [\App\Http\Controllers\ImageController::class, 'store']);
Route::get('carousels', [\App\Http\Controllers\CarouselController::class, 'index']);
Route::post('carousels', [\App\Http\Controllers\CarouselController::class, 'store']);
Route::post('carousels-edit', [\App\Http\Controllers\CarouselController::class, 'edit']);
Route::post('carousels-delete', [\App\Http\Controllers\CarouselController::class, 'delete']);
// Route::post('testeInsertUser', [\App\Http\Controllers\AuthController::class, 'testeInsertUser']);
