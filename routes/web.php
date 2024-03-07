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


route::get('/loginForm', function(){
    return view('FormLogin');
})->name('login');




Route::middleware(['auth'])->group(function () {





});
Route::resource('usuario', App\Http\Controllers\UsuarioController::class);
Route::GET('usuario/create', [App\Http\Controllers\UsuarioController::class, 'create']);
Route::post('auth', [App\Http\Controllers\UsuarioController::class, 'authenticate']);
Route::get('logout', [App\Http\Controllers\UsuarioController::class, 'logout']);





route::get('/notifTest', function(){
    return view('notificationsTest');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/provider/home', function (){
        $user = Auth::user();

    return view('provider.homeProv', compact('user'));
    });


    route::get('/rider.homeRid', function(){
        return view('testMapbox');
    });



});
