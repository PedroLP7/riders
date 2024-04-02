<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('landing');
});







Route::middleware(['auth'])->group(function () {
});




Route::resource('usuario', App\Http\Controllers\UsuarioController::class);
Route::GET('usuario/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('login');;
Route::post('auth', [App\Http\Controllers\UsuarioController::class, 'authenticate']);
Route::get('logout', [App\Http\Controllers\UsuarioController::class, 'logout']);

Route::get('/customerform', function () {
    return view('addHomelessForm.newHomelessPerson');
});



route::get('/notifTest', function(){
    return view('notificationsTest');
});

route::get('/updateBooking', function(){
    return view('updateBookingStatus');
});

route::get('/recurringCustomer', function(){
    return view('rider.recurringCustomer');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/provider/home', function (){

        $user = Auth::user();

    return view('provider.homeProv', compact('user'));
    });


    route::get('/rider/home', function(){
        return view('rider.homeRid');
    });


    route::get('/viewProviders', function(){
        return view('rider.viewProvider');
    });


    route::get('/provider/createMenu', function(){
        return view('provider.createMenu');
    });


    route::get('/rider/addKitchen', function(){
        return view('rider.addCommunityK');
    });

  route::get('/provider/bookings', function(){
        return view('provider.bookings');
    });

    route::get('/provider/profile', function(){
        return view('provider.profile');
    });


    route::get('/provider/edit', function(){
        return view('provider.editProfile');
    });

    route::get('/provider/editMenu/{idMenu}', function($idMenu){
        return view('provider.editMenu',compact('idMenu'));
    });

    route::get('/rider/viewMenu/{idProvider}', function($idProvider){
        return view('rider.viewProvidersMenus',compact('idProvider'));
    });


    });






    route::get('/provider/chart', function(){
        return view('provider.chart');
    });
