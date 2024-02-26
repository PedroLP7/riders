<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/customerform', function () {
    return view('addHomelessForm.newHomelessPerson');
});
Route::get('/', function () {
    return view('vue');
});


// route::get('/login', [UsuarioController::class,'showlogin'])->name('login');
// route::post('/login', [UsuarioController::class,'login']);
// route::get('/logout', [UsuarioController::class,'logout']);

Route::resource ('customer', CustomerController::class);
Route::middleware(['auth'])->group(function () {

    route::get('/home', [Controller::class,'home']);

    route::get('/admin', [UsuarioController::class,'admin']);
});
Route::resource('usuario', App\Http\Controllers\UsuarioController::class);
