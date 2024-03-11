<?php

namespace App\Http\Controllers\Api;


use App\Clases\Utilidad;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $customer = Customer::all();
            $response = CustomerResource::collection($customer);
        } catch (\Throwable $th) {
           $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }
        return $response;

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $customer = new Customer();
        $customer->location = $request->input('location');
        $customer->Xcoord = $request->input('Xcoord');
        $customer->Ycoord = $request->input('Ycoord');
        $customer->isActive = 1;

        try {
            $customer->save();
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
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {


            $customer->delete();

            return response()->json(['Usuario eliminado'], 200);
        } catch (\Throwable $th) {
            $customer->isActive=0;
            $customer->save();

            return response()->json(['message' => 'Usuario dado de baja '], 500);
        }
    }
}
