<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RiderController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProviderController;

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
})->name('home');












Route::resource('usuario', App\Http\Controllers\UsuarioController::class);
Route::GET('usuario/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('login');;
Route::post('auth', [App\Http\Controllers\UsuarioController::class, 'authenticate']);
Route::get('logout', [App\Http\Controllers\UsuarioController::class, 'logout']);

Route::get('/customerform', function () {
    return view('addHomelessForm.newHomelessPerson');
});

Route::get('/riderForm', function () {
    return view('rider.riderForm');
});
Route::get('/riderForm', function () {
    return view('rider.riderForm');
});
Route::get('/providerForm', function () {
    return view('provider.ProviderForm');
});
Route::get('/kitchenForm', function () {
    return view('kitchen.kitchenForm');
});






route::get('/notifTest', function(){
    return view('notificationsTest');
});

route::get('/updateBooking', function(){
    return view('updateBookingStatus');
});





Route::middleware(['auth'])->group(function () {










        Route::middleware(['CheckAdmin'])->group(function () {
            route::get('/admin/home', [UsuarioController::class, 'index'])->name('adminHome');

            route::get('/admin/riders', [RiderController::class, 'index']);
            route::get('admin/riders/edit/{rider}', [RiderController::class, 'edit']);
            route::put('admin/riders/update/{rider}', [RiderController::class, 'update']);
            route::delete('admin/riders/delete/{rider}', [RiderController::class, 'destroy']);
            route::put('admin/riders/reactivate/{rider}', [RiderController::class, 'reactivate']);
            route::get('admin/riders/create', [RiderController::class, 'create']);
            route::post('admin/riders/store', [RiderController::class, 'store']);



            route::get('/admin/providers', [ProviderController::class, 'index']);
            route::get('admin/providers/edit/{provider}', [ProviderController::class, 'edit']);
            route::put('admin/providers/update/{provider}', [ProviderController::class, 'update']);
            route::delete('admin/providers/delete/{provider}', [ProviderController::class, 'destroy']);
            route::put('admin/providers/reactivate/{provider}', [ProviderController::class, 'reactivate']);
            route::get('admin/providers/create', [ProviderController::class, 'create']);
            route::post('admin/providers/store', [ProviderController::class, 'store']);



            route::get('/admin/customers', [CustomerController::class, 'index']);
            route::get('admin/customers/edit/{customer}', [CustomerController::class, 'edit']);
            route::put('admin/customers/update/{customer}', [CustomerController::class, 'update']);
            route::delete('admin/customers/delete/{customer}', [CustomerController::class, 'destroy']);
            route::put('admin/customers/reactivate/{customer}', [CustomerController::class, 'reactivate']);
            route::get('admin/customers/create', [CustomerController::class, 'create']);
            route::post('admin/customers/store', [CustomerController::class, 'store']);





            route::get('/admin/bookings', [BookingController::class, 'index']);
            route::get('admin/bookings/edit/{booking}', [BookingController::class, 'edit']);
            route::put('admin/bookings/update/{booking}', [BookingController::class, 'update']);
            route::delete('admin/bookings/delete/{booking}', [BookingController::class, 'destroy']);

            route::get('admin/bookings/create', [BookingController::class, 'create']);
            route::post('admin/bookings/store', [BookingController::class, 'store']);
            route::delete('admin/bookings/delete/{booking}', [BookingController::class, 'destroy']);




        });







        Route::middleware(['CheckProvider'])->group(function () {


            Route::get('/provider/home', function (){

                $user = Auth::user();

            return view('provider.homeProv', compact('user'));
            })->name('providerHome');



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

            route::get('/provider/createMenu', function(){
                return view('provider.createMenu');
            });























        });


        Route::middleware(['CheckRider'])->group(function () {

             route::get('/rider/home', function(){
                return view('rider.homeRid');
            })->name('riderHome');




            route::get('/rider/viewProviders', function(){
                return view('rider.viewProvider');
            });

            route::get('/rider/profile', function(){
                return view('rider.riderProfile');
            });




            route::get('/rider/addKitchen', function(){
                return view('rider.addCommunityK');
            });
            route::get('/rider/bot', function(){
                return view('rider.bot');
            });


            route::get('/rider/recurringCustomer', function(){
                return view('rider.recurringCustomer');
            });



            route::get('/rider/edit', function(){
                return view('rider.editProfileRider');
            });




            route::get('/rider/viewMenu/{idProvider}', function($idProvider){
                return view('rider.viewProvidersMenus',compact('idProvider'));
            });



            route::get('rider/viewAllBookings', function(){
                return view('rider.viewAllBookingsPendingCollection');
            });




















        });



    });







    route::get('/provider/chart', function(){
        return view('provider.chart');
    });





