<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;

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

Route::get('/', function () {
    return view('vue');
});

Route::get('/index', [Controller::class,'index']);
route::get('/login', [UsuarioController::class,'showlogin']);
route::post('/login', [UsuarioController::class,'login']);
route::get('/logout', [UsuarioController::class,'logout']);



