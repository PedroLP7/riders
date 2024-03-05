<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CharityMenuResource;
use App\Models\charity_menu;
use Illuminate\Http\Request;

class CharityMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $charity_menu = charity_menu::with('providers')->get();
            $response  = CharityMenuResource::collection($charity_menu);
        } catch (\Throwable $th) {
            $response = response()->json(['message' => 'Error al obtener los datos'], 500);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $charity_menu = new charity_menu();
        $charity_menu->item1 = $request->item1;
        $charity_menu->item2 = $request->item2;
        $charity_menu->item3 = $request->item3;

        $charity_menu->save();









    }

    /**
     * Display the specified resource.
     */
    public function show(charity_menu $charity_menu)
    {
        try {
            $charity_menu = charity_menu::with('providers')->find($charity_menu->id_menu);
            $response=  new CharityMenuResource($charity_menu);
        } catch (\Throwable $th) {
          $response=response()->json(['message' => 'Error al obtener los datos'], 500);
        }

         return $response;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, charity_menu $charity_menu)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(charity_menu $charity_menu)
    {
        try {
            $charity_menu->delete();
            $response = response()->json(['message' => 'Menu eliminado correctamente']);
        } catch (\Throwable $th) {
            $response = response()->json(['message' => 'Error al eliminar el menu'], 500);
        }
        return $response;

    }


    public function asignarProvider(Request $request, charity_menu $charity_menu){
        $charity_menu->providers()->attach($request->provider_id, ['quantity' => $request->quantity]);




        return response()->json(['message' => 'Provider asignado a este menu']);
    }



}
