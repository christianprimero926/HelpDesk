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
        //dd($idRolActual);
        $idMenuActual = Menu::where('as', $ruta);
        //dd($idMenuActual->get());
        if($idMenuActual->count()){
            $permisos = Permit::where('menu_id',$idMenuActual->first()->id)->where('profile_id',$idRolActual);
            if ($permisos->count()) {
                 return $next($request);
            }else{
                
               return redirect('/home')->with('notification-warning', 'NO Posees permisos para acceder a esta vista.');                
            }
        }
        return $next($request);
    }
}
