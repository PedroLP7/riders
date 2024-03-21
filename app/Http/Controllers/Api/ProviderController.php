<?php

namespace App\Http\Controllers\Api;

use App\Models\usuario;
use App\Models\provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;


class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $providers= usuario::with('provider')->where('user_type_id', 3)->get();
            $response = ProviderResource::collection($providers);
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
        DB::beginTransaction();
        try {
            $usuario = new usuario();
            $usuario->user_name=$request->user_name;
            $pwd =bcrypt($request->password);
            $usuario->pswd=$pwd;
            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;
            $usuario->isActive=1;
            $usuario->imgProfile=$request->imgProfile;
            // falta gestionar que coja el file , ya se hara, de momento coge un varchar

            $usuario->user_type_id=3;

            $usuario->save();
           $provider = new provider();


            $provider->id_provider = $usuario->id_user;
            $provider->adress = $request->adress;


            $provider->save();
            DB::commit();
            $response = response()
            ->json(['Provider creado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['error' => 'Error al crear el rider: ' . $th->getMessage()], 500);
        }



        return $response;

    }

    /**
     * Display the specified resource.
     */
    public function show(provider $provider)
    {
        try {
            $provider = usuario::with('provider.menus')->find($provider->id_provider);
            return  new ProviderResource($provider);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al mostrar el usuario: ' . $th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, provider $provider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($provider->id_provider);
            $usuario->user_name=$request->user_name;

            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;





            $usuario->save();




            $provider->adress = $request->adress;



            $provider->save();
            DB::commit();
            $response = response()
            ->json(['updateado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            $response= response()->json(['error' => 'Error al updatear el provider: ' . $th->getMessage()], 500);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(provider $provider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($provider->id_provider);

            $provider->delete();
            $usuario->delete();
            DB::commit();
            return response()->json(['Usuario eliminado'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar el usuario: ' . $th->getMessage()], 500);
        }
    }
}
