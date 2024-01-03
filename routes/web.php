<?php

use App\Http\Controllers\AuthenticationsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function() {
    return redirect('/home');
})->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/home/{id}', [HomeController::class, 'detail'])->middleware('auth');

Route::get('/register', [AuthenticationsController::class, 'indexRegister'])->middleware('guest');
Route::post('/register', [AuthenticationsController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthenticationsController::class, 'indexLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticationsController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthenticationsController::class, 'logout'])->middleware('auth');

Route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::get('/download/{id}', [DashboardController::class, 'download'])->middleware('auth');

Route::get('/kategori', [CategoryController::class, 'index']);
Route::post('/kategori', [CategoryController::class, 'store']);
Route::put('/kategori/{id}', [CategoryController::class, 'update']);
Route::delete('/kategori/{id}', [CategoryController::class, 'destroy']);
Route::get('/kategori-dashboard', [CategoryController::class, 'indexDashboard']);
