<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use App\Clases\Utilidad;
use App\Models\communityK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CommunityKitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $community = new communityK();
        $community->id_communityK = $request->input('id_communityK');
        $community->adress = $request->input('adress');
        $community->needs_food = $request->input('needs_food');
        
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

            $usuario->user_type=2;

            $usuario->save();
            $community = new communityK();
            $community->id_communityK = $request->input('id_communityK');
            $community->adress = $request->input('adress');
            $community->needs_food = $request->input('needs_food');


            $community->save();
            DB::commit();
            $response = response()
            ->json(['Rider creado'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['error' => 'Error al crear el rider: ' . $th->getMessage()], 500);
        }



        return $response;
    }

   
    public function show(communityK $communityK)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, communityK $communityK)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(communityK $communityK)
    {
        //
    }
}
