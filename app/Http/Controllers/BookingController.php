<?php

namespace App\Http\Controllers;

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
        //
        try {
            $booking = booking::all();
            $response = BookingResource::collection($booking);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar la reserva: ' . $th->getMessage()], 500);
        }
        return $response;


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booking $booking)
    {
        //
        $booking->id_rider_fk = $request->input('id_rider_fk');
        $booking->id_provider_fk = $request->input('id_provider_fk');
        $booking->id_menu_fk = $request->input('id_menu_fk');
        $booking->menu_quantity = $request->input('menu_quantity');
        $booking->id_status_fk = $request->input('id_status_fk');
        $booking->curr_date = $request->input('curr_date');
        try {
            $booking->save();
            $response = (new BookingResource($booking))
                ->response()
                ->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);
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
