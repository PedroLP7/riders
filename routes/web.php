<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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
    return view('landing');
});





Route::middleware(['auth'])->group(function () {




    route::get('/home', [Controller::class,'home']);

    route::get('/admin', [UsuarioController::class,'admin']);
});
Route::resource('usuario', App\Http\Controllers\UsuarioController::class);
Route::post('auth', [App\Http\Controllers\UsuarioController::class, 'authenticate']);
// route::resource('menu', App\Http\Controllers\CharityMenuController::class);
// route::resource('customer', App\Http\Controllers\CustomerController::class);

route::get('/map', function(){
    return view('testMapbox');
});

route::get('/notifTest', function(){
    return view('notificationsTest');
});

Route::middleware(['auth'])->group(function () { 
    Route::get('/home', function (){ 
        $user = Auth::user();
    
    return view('home', compact('user'));
    });
});
