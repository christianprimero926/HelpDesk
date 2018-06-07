<?php

namespace App\Http\Middleware;

use Closure;
use App\Menu;
use App\Permit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


class PermitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ruta = Route::currentRouteName();
        //dd($ruta);
        $idRolActual = Auth::User()->profile_id;

        $idMenuActual = Menu::where('as', $ruta);


        if($idMenuActual->count()){
            $permisos = Permit::where('menu_id',$idMenuActual->first()->id)->where('profile_id');
            //dd($permisos);
            if ($permisos->count()) {
                 return $next($request);
            }else{
                
               return redirect('/home')->with('notification-warning', 'No tienes permisos.');
                //return view('/home')->with('notification', 'No tienes permisos.');
                //return redirect('/');
                //return back()->with('notification', 'La nueva opción ha sido registrada exitosamente.');
            }
        }

        return $next($request);
    }
}
