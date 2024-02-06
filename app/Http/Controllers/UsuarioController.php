<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{


    public function showlogin() {

        // $usuario = new usuario();
        //   $usuario->username = 'Ivan';
        //   $usuario->pswrd = bcrypt('1234');
        //   $usuario->user_type_id = '2';
        //   $usuario->realName = 'Ivan';
        //   $usuario->surname1 = 'Martinez';
        //   $usuario->save();



        return view('auth.loginForm');
    }



    public function login(Request $request){


        $username = $request->input('username');
        $password = $request->input('password');

        $user = usuario::where('username', $username)->first();

        if($user !=null && Hash::check($password, $user->pswrd)){
        Auth::login($user);
            $response = redirect('/home');
            request()->session()->flash('mensaje', 'Bienvenido ' . $user->realName);

        }else{
            $request->session()->flash('error', 'Usuario o contraseña incorrectos');
            //  $request->session()->flash($username,$password);
        $response = redirect('/login')->withInput();
        }
        return $response;

}

public function admin(){
    if(Auth::user()->user_type_id != 1){
      $response =  redirect('/home');
    }else{
        $riders = usuario::where('user_type_id', 2)->get();


        $usuarios = usuario::all();
        // session()->flash('mensaje', 'Bienvenido a la zona de administración');
        $response =  view('adminZone.admin', compact('usuarios'));
    }
    return $response;
}

public function logout(){
    Auth::logout();
    request()->session()->flash('mensaje', 'Sesión cerrada');
    return redirect('/index');

}

function destroy(Request $request ,usuario $usuario){
    try {
        $usuario->delete();
        $request->session()->flash('mensaje', "Usuario $usuario->userName eliminado correctament");
        $response = redirect()->action([UsuarioController::class, 'admin']);

    } catch (\Throwable $th) {
        $request->session()->flash('error', "No se puede eliminar el usuario $usuario->userName");
        $response = redirect()->action([UsuarioController::class, 'admin']);
    }

    return $response;
}


function edit(usuario $usuario){
    return view('adminZone.edit', compact('usuario'));



}

}
