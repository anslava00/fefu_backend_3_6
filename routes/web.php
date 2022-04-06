<?php

use App\Http\Controllers\Web\AppealController;
use App\Http\Controllers\Web\PageWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\NewsWebController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appeal', [AppealController::class, 'form'])->name('appeal.form');
Route::post('/appeal', [AppealController::class, 'send'])->name('appeal.send');

Route::get('/pages', [PageWebController::class, 'index']);
Route::get('/pages/{slug}', [PageWebController::class, 'show']);
Route::get('/news', [NewsWebController::class, 'index']);
Route::get('/news/{slug}', [NewsWebController::class, 'show']);
