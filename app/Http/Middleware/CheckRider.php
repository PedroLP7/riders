<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();


        if( $user->user_type->type_name ==="Provider"&& $user->user_type->type_name != "Rider"){
            session()->flash('error', ' Para ver esta pagina tienes que ser rider.');
            return redirect()->route('providerHome');
        }else if($user->user_type->type_name ==="Admin"&& $user->user_type->type_name != "Rider"){
            session()->flash('error', ' Para ver esta pagina tienes que ser rider.');
            return redirect()->route('adminHome');

        }
        return $next($request);
    }
}
