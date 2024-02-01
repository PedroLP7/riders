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
        // $usuario->username = 'Geraldain';
        // $usuario->pswrd = bcrypt('1234');
        // $usuario->user_type_id = '1';
        // $usuario->realName = 'Geraldine';
        // $usuario->surname1 = 'Jara';
        // $usuario->save();



        return view('auth.loginForm');
    }



    public function login(Request $request){


        $username = $request->input('username');
        $password = $request->input('password');

        $user = usuario::where('username', $username)->first();

        if($user !=null && Hash::check($password, $user->pswrd)){
        Auth::login($user);
            $response = redirect('/home');
        }else{
            $request->session()->flash('error', 'Usuario o contraseña incorrectos');
        $response = redirect('/login');
        }
        return $response;

}

public function logout(){
    Auth::logout();
    return redirect('/index');

}
}
