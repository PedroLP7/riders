<?php

namespace App\Http\Controllers;

use App\Models\rider;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riders = Rider::all();
        return view('adminZone.Riders.index', compact('riders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminZone.Riders.create');
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
            $rider = new rider();


            $rider->id_rider = $usuario->id_user;
            $rider->surname1 = $request->surname1;
            $rider->surname2 = $request->surname2;
            $rider->mail = $request->mail;
            $rider->phone_number = $request->phone_number;


            $rider->save();
            DB::commit();
            $response = redirect('/admin/riders');


        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error',
        'Error al crear el usuario: ' . $th->getMessage());
        $response = redirect('/admin/riders/create')->withInput();

        }
        return $response;


    }

    /**
     * Display the specified resource.
     */
    public function show(rider $rider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rider $rider)
    {


        return view('adminZone.Riders.edit', compact('rider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rider $rider)
    {

        try {
            // dd($request->all());

            $usuario = usuario::find($rider->id_rider);

            $usuario->user_name=$request->user_name;

            $usuario->dni_cif=$request->dni_cif;
            $usuario->real_name=$request->real_name;
            //  $usuario->isActive=1;
            $usuario->save();
            $rider->surname1 = $request->surname1;
            $rider->surname2 = $request->surname2;
            $rider->mail = $request->mail;
            $rider->phone_number = $request->phone_number;
            $rider->save();
            $response = redirect('/admin/riders/');
        } catch (\Throwable $th) {

            session()->flash('error',"error al editar el usuario: ".$th->getMessage());
            $response = redirect('/admin/riders/edit/')->withInput();
        }
        return $response;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rider $rider)
    {
        $usuario = usuario::find($rider->id_rider);
        $usuario->isActive = 0;

        $usuario->save();
        return redirect('/admin/riders');
    }

    public function reactivate(rider $rider)
    {
        $usuario = usuario::find($rider->id_rider);
        $usuario->isActive = 1;

        $usuario->save();
        return redirect('/admin/riders');
    }
}
