<?php

use App\Http\Controllers\Customer;
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


// Route::get ('/createcustomer'[CustomerController::class], 'create');
Route::middleware(['auth'])->group(function () {



    route::get('/home', [Controller::class,'home']);

    route::get('/admin', [UsuarioController::class,'admin']);
});
Route::resource('usuario', App\Http\Controllers\UsuarioController::class);

route::get('/map', function(){
    return view('testMapbox');
});
