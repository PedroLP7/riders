<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        return view('index');
    }
    public function home()
    {
        $user = Auth::user();
        //intentar gestionar esto

        // session()->flash('error', 'no estas logueado');



        return view('home',compact('user'));
    }
}
