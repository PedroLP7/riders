<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;

class UsuarioController extends Controller
{
    //Authenthicate
    public function authenticate(Request $request){
        $username = $request->input("user_name");
        $contrasenya = $request->input("pswd");
        $user = Usuario::where('user_name', $username)->first();
        if ($user != null && Hash::check($contrasenya, $user->pswd)) {
        Auth::login($user);
        if(Auth::user()->user_type->type_name == 'Rider'){
            $response = redirect('/rider/home');
        } else {
            $response = redirect('/provider/home');
        }

        } else {
        $request->session()->flash('error',
        'Usuari o contrasenya incorrectes');
        $response = redirect('/usuario/create')->withInput();
    }
        return $response;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('adminZone.home', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.loginForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('adminZone.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
