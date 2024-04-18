<?php

namespace App\Http\Controllers\Api;

use App\Models\booking;
use App\Models\rider;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RidersResource;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $riders = usuario::with('rider')->where('user_type_id', 2)->get();
            $response = RidersResource::collection($riders);
        } catch (\Throwable $th) {
           $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }
        return $response;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
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

            $usuario->user_type_id=2;

            $usuario->save();
            $rider = new rider();


            $rider->id_rider = $usuario->id_user;
            $rider->surname1 = $request->surname1;
            $rider->surname2 = $request->surname2;
            $rider->mail = $request->mail;
            $rider->phone_number = $request->phone;


            $rider->save();
            DB::commit();
            $response = response()
            ->json(['Rider creado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['error' => 'Error al crear el rider: ' . $th->getMessage()], 500);
        }



        return $response;


    }

    /**
     * Display the specified resource.
     */
    public function show(rider $rider)
    {
        try {
            $rider = usuario::with('rider')->find($rider->id_rider);
            return  new RidersResource($rider);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al mostrar el usuario: ' . $th->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rider $rider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($rider->id_rider);
            $usuario->user_name=$request->user_name;

            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;

            $usuario->imgProfile=$request->imgProfile;
            // falta gestionar que coja el file , ya se hara, de momento coge un varchar



            $usuario->save();




            $rider->surname1 = $request->surname1;
            $rider->surname2 = $request->surname2;
            $rider->mail = $request->mail;
            $rider->phone_number = $request->phone;


            $rider->save();
            DB::commit();
            $response = response()
            ->json(['updateado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            $response= response()->json(['error' => 'Error al updatear el rider: ' . $th->getMessage()], 500);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rider $rider)
    {
        DB::beginTransaction();
        try {
            $usuario = usuario::find($rider->id_rider);

            $rider->delete();
            $usuario->delete();
            DB::commit();
            return response()->json(['Usuario eliminado'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar el usuario: ' . $th->getMessage()], 500);
        }
    }




    public function deliverysByRider($rider){
        try {
            $deliveryscount = booking::with('rider')->where('id_rider_fk', $rider)
            ->where('id_status_fk', '3')->count();

            return response()->json($deliveryscount, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al mostrar los deliverys: ' . $th->getMessage()], 500);
        }




    }

}
