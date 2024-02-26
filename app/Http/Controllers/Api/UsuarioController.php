<?php

namespace App\Http\Controllers\Api;

use App\Models\rider;
use App\Models\usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $usuarios = usuario::all();
        return response()
            ->json($usuarios, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = new usuario();
        $usuario->user_name=$request->user_name;
        $pwd =bcrypt($request->password);
        $usuario->pswd=$pwd;
        $usuario->dni_cif=$request->dni_cif;
        $usuario->real_name=$request->real_name;
        $usuario->user_type=2;


        $rider = new rider();
        //no pilla bien el iduser , cambiarlo

        $rider->id_rider = $usuario->id_user;
        $rider->surname1 = $request->surname1;
        $rider->surname2 = $request->surname2;
        $rider->mail = $request->mail;
        $rider->phone_number = $request->phone;
        try {
            $usuario->save();


            $rider->save();
            $response = response()
            ->json(['Rider creado'], 200);

        } catch (\Throwable $th) {
            // Aquí capturamos y devolvemos el mensaje de error
            return response()->json(['error' => 'Error al crear el rider: ' . $th->getMessage()], 500);
        }



        return $response;



    }

    /**
     * Display the specified resource.
     */
    public function show(usuario $usuario)
    {
        //
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
        //
    }
}
