<?php

namespace App\Http\Controllers\Api;

use App\Models\delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\DeliveryResource;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $delivery = delivery::with('customer')->get();
            $response = DeliveryResource::collection($delivery);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar la reserva: ' . $th->getMessage()], 500);
        }
        return $response;
    }
    public function deliveriesByCustomer()
    {
        try {
            $deliveries = Delivery::select('id_customer_fk', DB::raw('COUNT(*) as count'))
                ->groupBy('id_customer_fk')
                ->orderByDesc('count')
                ->with('customer')
                ->get();
            
            $response = DeliveryResource::collection($deliveries);
        } catch (QueryException $e) {
            $response = response()->json(['error' => 'Error al mostrar la reserva: ' . $e->getMessage()], 500);
        }
        
        return $response;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
