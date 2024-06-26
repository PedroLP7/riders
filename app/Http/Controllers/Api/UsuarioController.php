<?php

namespace App\Http\Controllers\Api;

use App\Models\rider;
use App\Models\booking;
use App\Models\usuario;
use App\Models\provider;
use App\Models\communityK;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UsuarioResource;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuarios = usuario::with('user_type')->get();
            $response = UsuarioResource::collection($usuarios);
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
    //    DB::beginTransaction();
    //     try {
    //         $usuario = new usuario();
    //         $usuario->user_name=$request->user_name;
    //         $pwd =bcrypt($request->password);
    //         $usuario->pswd=$pwd;
    //         $usuario->dni_cif=$request->dni_cif;
    //         $usuario->real_name=$request->real_name;
    //         $usuario->isActive=1;
    //         $usuario->imgProfile=$request->imgProfile;
    //         // falta gestionar que coja el file , ya se hara, de momento coge un varchar

    //         $usuario->user_type=2;

    //         $usuario->save();
    //         $rider = new rider();


    //         $rider->id_rider = $usuario->id_user;
    //         $rider->surname1 = $request->surname1;
    //         $rider->surname2 = $request->surname2;
    //         $rider->mail = $request->mail;
    //         $rider->phone_number = $request->phone;


    //         $rider->save();
    //         DB::commit();
    //         $response = response()
    //         ->json(['Rider creado'], 200);

    //     } catch (\Throwable $th) {
    //         DB::rollBack();

    //         return response()->json(['error' => 'Error al crear el rider: ' . $th->getMessage()], 500);
    //     }



    //     return $response;



    }

    /**
     * Display the specified resource.
     */
    public function show(usuario $usuario)
    {
        // try {
        //     $usuario = usuario::with('rider')->find($usuario);
        //     return UsuarioResource::collection($usuario);

        // } catch (\Throwable $th) {
        //     return response()->json(['error' => 'Error al mostrar el usuario: ' . $th->getMessage()], 500);
        // }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(usuario $usuario)
    {

        try {


            $usuario->delete();

            return response()->json(['Usuario eliminado'], 200);
        } catch (\Throwable $th) {
            $usuario->isActive=0;
            $usuario->save();

            return response()->json(['message' => 'Usuario dado de baja '], 500);
        }
    }



    public function getUsuario(Request $request)
    {
        if (Auth::check()) {
            $user= Auth::user();
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    }

    public function getUsuarioType($id){
        try {
            $usuarios = usuario::where('id_user','=', $id)->with('user_type')->get();
            $response = UsuarioResource::collection($usuarios);
        } catch (\Throwable $th) {
           $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }
        return $response[0];
    }

    public function getUsuariosWithType($id){

        try {
            $usuarios = usuario::where('user_type_id','=', $id)
            ->with('provider', 'rider', 'communityK')
            ->get();
            $response = UsuarioResource::collection($usuarios);
        } catch (\Throwable $th) {
           $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }
        return $response;
    }




    public function getStats1(){
        try {
            $stats = Booking::where('id_status_fk', '=', 3)
                           ->with(['provider.user' => function ($query) {
                               $query->select('id_user', 'user_name');
                           }])
                           ->get()
                           ->groupBy(function($item) {
                                return $item->provider->user->user_name;
                            })
                           ->map(function ($items, $key) {
                                return [
                                    'provider_name' => $key,
                                    'bookings' => $items->count()
                                ];
                            })
                           ->sortByDesc('bookings')
                           ->take(5);

            $response = response()->json(['stats' => $stats], 200);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }

        return $response;
    }



    public function getActiveUsers(){
        try {
            $usuarios = usuario::where('isActive', '=', 1)->get();
           $ActiveUsers =  $usuarios->count();

            $response = response()->json($ActiveUsers, 200);
        } catch (\Throwable $th) {
           $response = response()->json(['error' => 'Error al mostrar los usuarios: ' . $th->getMessage()], 500);
        }
        return $response;
    }

    public function getTotalKg(){
        try {
            $kg= booking::where('id_status_fk', '=', 3)->count();
            $total = $kg * 0.5;
            $response = response()->json($total, 200);
        } catch (\Throwable $th) {
            $response = response()->json(['error' => 'Error al mostrar los kg totales ' . $th->getMessage()], 500);
        }
        return $response;

    }












}
