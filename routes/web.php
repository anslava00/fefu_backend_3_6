<?php

use App\Http\Controllers\Web\ProductWebController;
use App\Http\Controllers\Web\AppealWebController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CatalogController;
use App\Http\Controllers\Web\PageWebController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\NewsWebController;
use App\Http\Controllers\Web\OAuthController;
use App\Http\Controllers\Web\WebCartController;
use App\Http\Controllers\Web\OrderController;
use Illuminate\Support\Facades\Route;



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

Route::get('/checkout', [ OrderController::class, 'index'])
    ->middleware('auth')
    ->name('checkout.get');

Route::post('/checkout', [ OrderController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.post');

Route::get('/cart', WebCartController::class)
    ->middleware('auth.optional');

Route::get('/catalog/{slug?}', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/product/{slug}', [ProductWebController::class, 'index'])->name('product');

Route::prefix('/oauth')->group(function () {
    Route::get('/{provider}/redirect', [OAuthController::class, 'redirectToService'])->name('oauth.redirect');
    Route::get('/{provider}/login', [OAuthController::class, 'login'])->name('oauth.login');
});

Route::get('/appeal', [AppealWebController::class, 'form'])->name('appeal.form');
Route::post('/appeal', [AppealWebController::class, 'send'])->name('appeal.send');

Route::get('/profile', action:[ProfileController::class, 'show'])
    ->name('profile')
    ->middleware('auth');


Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::get('/pages', [PageWebController::class, 'index']);
Route::get('/pages/{slug}', [PageWebController::class, 'show']);
Route::get('/news', [NewsWebController::class, 'index']);
Route::get('/news/{slug}', [NewsWebController::class, 'show']);
