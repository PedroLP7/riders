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
            $charity_menu = charity_menu::with('providers')
            ->where('isActive', 1)
            ->get();
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
        $charity_menu->isActive = 1;

        try {
            $charity_menu->save();
            $charity_menu->providers()->attach($request->provider_id, ['quantity' => $request->quantity]);

            $response = response()->json(['message' => 'Menu creado correctamente']);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al crear el menu'], 500);

        }
        return $response;
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
          $response=response()->json(['error' => 'Error al obtener los datos'], 500);
        }

         return $response;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, charity_menu $charity_menu)
    {

        $charity_menu->item1 = $request->item1;
        $charity_menu->item2 = $request->item2;
        $charity_menu->item3 = $request->item3;
        $charity_menu->providers()->updateExistingPivot($request->provider_id, ['quantity' => $request->quantity]);

        try {
            $charity_menu->save();
            $response = response()->json(['message' => 'Menu actualizado correctamente']);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al actualizar el menu'], 500);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(charity_menu $charity_menu)
    {
        try {
            $charity_menu->isActive=0;
            $charity_menu->save();

            $response = response()->json(['message' => 'Menu eliminado correctamente']);
        } catch (\Throwable $th) {
            $response = response()->json(['error' =>  'Error al eliminar el menu',$th], 500);
        }
        return $response;

    }







    // public function desasignarProvider(Request $request, charity_menu $charity_menu){
    //     try {
    //         $charity_menu->providers()->detach($request->provider_id);
    //         $response = response()->json(['message' => 'Provider desasignado de este menu']);
    //     } catch (\Throwable $th) {
    //         $response = response()->json(['error' => 'Error al desasignar el provider'], 500);
    //     }
    //     return $response;
    // }










}
