<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilidad;
use App\Models\delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\DeliveryResource;

class DeliveryController extends Controller
{
    public function index()
    {
        //
        try {
            $delivery = delivery::all();
            $response = DeliveryResource::collection($delivery);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar la reserva: ' . $th->getMessage()], 500);
        }
        return $response;


    }
    public function deliveriesByCustomer()
{
    try {
        // Selecting the count of deliveries grouped by customer ID
        $deliveries = Delivery::select('id_customer_fk', DB::raw('COUNT(*) as count'))
            ->groupBy('id_customer_fk')
            ->orderByDesc('count')
            ->with('customer') // Eager loading the customer relationship
            ->get(); // Getting the results

        // Prepare an array to hold the formatted data
        $formattedDeliveries = [];

        // Loop through the deliveries and format the data
        foreach ($deliveries as $delivery) {
            $formattedDeliveries[] = [
                'customer_id' => $delivery->id_customer_fk,
                'count' => $delivery->count,
                'customer' => $delivery->customer // Assuming the customer relationship is loaded properly
            ];
        }

        // Create the response JSON including count and deliveries
        $response = response()->json([
            'count' => $deliveries->count(), // Total count of deliveries
            'deliveries' => $formattedDeliveries
        ]);

    } catch (QueryException $e) {
        // Handling any database query exceptions
        $response = response()->json(['error' => 'Error al mostrar la reserva: ' . $e->getMessage()], 500);
    }

    return $response; // Returning the response
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $delivery = new delivery();
        $delivery->id_delivery = $request->input('id_delivery');
        $delivery->id_booking_fk = $request->input('id_booking_fk');
        $delivery->delivery_date = $request->input('delivery_date');
        $delivery->delivery_hour = $request->input('delivery_hour');
        $delivery->id_customer_fk = $request->input('id_customer_fk');
        $delivery->id_communityK_fk = $request->input('id_communityK_fk');

        try {
            $delivery->save();
            $response = response()->json(['bien insertado'], 200);

        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMessage($ex);
            $response = response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(delivery $delivery)
    {
        //
    }
}
