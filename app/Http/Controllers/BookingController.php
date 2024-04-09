<?php

namespace App\Http\Controllers;

use App\Models\booking_status;
use App\Models\charity_menu;
use App\Models\provider;
use App\Models\rider;


use App\Models\booking;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;
use Illuminate\Database\QueryException;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('id_status_fk', 1)
                  ->orWhere('id_status_fk', 2)

                  ->get();

        return view('adminZone.Bookings.index', compact('bookings'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $booking = new Booking();
        $booking->id_rider_fk = $request->input('id_rider_fk');
        $booking->id_provider_fk = $request->input('id_provider_fk');
        $booking->id_menu_fk = $request->input('id_menu_fk');
        $booking->menu_quantity = $request->input('menu_quantity');
        $booking->id_status_fk = $request->input('id_status_fk');
        $booking->curr_date = $request->input('curr_date');

        try {
            $booking->save();
            $response = response()->json(['bien insertado'], 200)
                ->response()
                ->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMessage($ex);
            $response = response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(booking $booking)
    {


        $riders = rider::all();
        $providers = provider::with('menus')->get();
        $status = booking_status::all();
        foreach ($booking->provider->menus as $charity_menu) {
            $quantity = $charity_menu->pivot->quantity;
            dd($quantity);
        }








        return view('adminZone.Bookings.edit', compact('booking', 'riders', 'providers', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booking $booking)
    {

        // $quantity = $booking->charity_menu->pivot.quantity;
        // dd($quantity);
        $booking->id_rider_fk = $request->input('id_rider_fk');


        $booking->menu_quantity = $request->input('menu_quantity');
        // if($request->input('menu_quantity'))
        $booking->id_status_fk = $request->input('id_status_fk');

        try {
            $booking->save();
            $response = redirect('/admin/bookings/');
        } catch (\Throwable $th) {
            session()->flash('error',"error al editar el booking: ".$th->getMessage());
            $response = redirect('/admin/bookings/edit/')->withInput();

        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(booking $booking)
    {
        //
    }
}
