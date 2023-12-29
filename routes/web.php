<?php

use App\Http\Controllers\AuthenticationsController;
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
    return view('home.index');
})->middleware('auth');

Route::get('/register', [AuthenticationsController::class, 'indexRegister']);
Route::post('/register', [AuthenticationsController::class, 'register']);
Route::get('/login', [AuthenticationsController::class, 'indexLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticationsController::class, 'login']);
Route::post('/logout', [AuthenticationsController::class, 'logout']);
