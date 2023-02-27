<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//? STORES ROUTES
Route::get('/stores', [StoreController::class, 'index']);

//? PRODUCTS ROUTES
Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'detail']);
    Route::post('/create', [ProductController::class, 'create']);
    Route::put('/edit/{id}', [ProductController::class, 'edit']);
    Route::delete('/remove/{id}', [ProductController::class, 'remove']);
});
