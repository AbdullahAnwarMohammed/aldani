<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = null): Response
    {
        if ((request()->is('admin/*') || request()->is('admin')) && Auth::guard('admin')->check())
        return redirect('admin');

        if ((request()->is('login/*') || request()->is('login')) && Auth::check())
        return redirect('almuhfazun');



        // if(!Auth::guard('admin')->check())
        // {
        //  return redirect('/xx');
        // }
        // if(Auth::check())
        // {
        //     return redirect('/almuhfazun');
        // }
        
        //    foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         if ($guard === 'admin') {
        //             return redirect('/admin/dashboard');
        //         } else {
        //             return redirect('/home');
        //         }
        //     }
        // }

        // if (Auth::guard($guard)->check()) {
        //     if ($guard == 'admin')
        //         return redirect(RouteServiceProvider::ADMIN);
        //     else
        //     return redirect('/admin/login');
        // }
  
       
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     dd($guard);
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }
        
        return $next($request);
    }
}
