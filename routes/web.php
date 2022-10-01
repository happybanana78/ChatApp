<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\Chat;
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
    return view('users.sign-up');
})->middleware("guest");

Route::get('/login', function () {
    return view('users.login');
})->middleware("guest")->name("login");

Route::get('/control', Chat::class)->middleware("auth");

Route::post("/create", [UserController::class, "createAccount"])->middleware("guest");

Route::post("/signin", [UserController::class, "login"])->middleware("guest");