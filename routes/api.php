<?php

use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PageApiController;
use App\Http\Controllers\Api\AppealApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CatalogApiController;
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

Route::middleware('auth:sanctum')->group( function () {
    Route::get('user', [AuthApiController::class, 'user']);
    Route::post('logout', [AuthApiController::class, 'logout']);
});


Route::post('login', [AuthApiController::class, 'login']);
Route::post('register', [AuthApiController::class, 'register']);


Route::apiResource('catalog', CatalogApiController::class)->only([
    'index',
    'show',
]);

Route::apiResource('appeal', AppealApiController::class)->only([
    'store',
]);

Route::apiResource('news', NewsApiController::class)->only([
    'index',
    'show',
]);

Route::apiResource('pages', PageApiController::class)->only([
    'index',
    'show',
]);