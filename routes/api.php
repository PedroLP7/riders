<?php

use App\Http\Controllers\Api\DeliveryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RiderController;
use App\Http\Controllers\Api\BookingController;

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\CharityMenuController;
use App\Http\Controllers\Api\CommunityKitchenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});

Route::apiResource ('customer', CustomerController::class);


Route::middleware(['web', 'auth'])->group(function () {

Route::get('usuario/getUsuario', [UsuarioController::class, 'getUsuario']);

});

Route::get('booking/showBookingByUserId/{id}', [BookingController::class, 'showWithId']);
Route::get('usuario/getUsuarioType/{id}', [ UsuarioController::class, 'getUsuarioType']);
Route::get('usuario/getUsuariosWithType/{id}', [ UsuarioController::class, 'getUsuariosWithType']);
route::get('provider/getBookings/{provider}', [App\Http\Controllers\Api\ProviderController::class, 'bookingsByProvider']);
route::get('provider/getKG/{provider}', [App\Http\Controllers\Api\ProviderController::class, 'getKg']);
route::get('provider/deliverysByProvider/{provider}', [App\Http\Controllers\Api\ProviderController::class, 'deliverysByProvider']);
route::get('provider/getDifference/{provider}', [App\Http\Controllers\Api\ProviderController::class, 'calculateMonthlyChange']);


route::put('provider/updateQuantity/{quantity}/{provider_id}/{menu_id}', [ProviderController::class, 'updateQuantity']);
route::put('charity_menu/{charity_menu}/asignarProvider', [CharityMenuController::class, 'asignarProvider']);
route::apiResource('charity_menu',CharityMenuController::class);
route::apiResource('usuario', UsuarioController::class);
route::apiResource('rider', RiderController::class);
route::apiResource('provider', ProviderController::class);
route::apiResource('booking', BookingController::class);
route::apiResource('communityk', CommunityKitchenController::class);
route::apiResource('delivery', DeliveryController::class);

Route::get('deliveriesByCustomer', [ DeliveryController::class, 'deliveriesByCustomer']);




