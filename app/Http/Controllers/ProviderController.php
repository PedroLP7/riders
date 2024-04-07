<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use App\Models\provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers= provider::all();
        return view('adminZone.Providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminZone.Providers.create');
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
            $usuario->real_name=$request->real_name;


            $usuario->isActive=1;

            $usuario->dni_cif=$request->dni_cif;

            $usuario->user_type_id=2;

            $usuario->save();
            $provider= new provider();


            $provider->id_rider = $usuario->id_user;
            $provider->adress = $request->adress;



            $provider->save();
            DB::commit();
            $response = redirect('/admin/providers');


        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error',
        'Error al crear el provider: ' . $th->getMessage());
        $response = redirect('/admin/providers/create')->withInput();

        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(provider $provider)
    {
        return view('adminZone.Providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, provider $provider)
    {
        try {


            $usuario = usuario::find($provider->id_provider);

            $usuario->user_name=$request->user_name;

            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;
            //  $usuario->isActive=1;
            $usuario->save();
            $provider->adress = $request->adress;

            $provider->save();
            $response = redirect('/admin/providers/');
        } catch (\Throwable $th) {

            session()->flash('error',"error al editar el usuario: ".$th->getMessage());
            $response = redirect('/admin/providers/edit/')->withInput();
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(provider $provider)
    {
        $usuario = usuario::find($provider->id_provider);
        $usuario->isActive = 0;

        $usuario->save();
        return redirect('/admin/providers');
    }


    public function reactivateP(provider $provider)
    {
        $usuario = usuario::find($provider->id_provider);
        $usuario->isActive = 1;

        $usuario->save();
        return redirect('/admin/providers');
    }




}
