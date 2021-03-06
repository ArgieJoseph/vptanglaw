<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                # code...
             if (Auth::guard($guard)->check()) {
            return redirect('admin/home');
        }
                break;
                case 'Director':
                # code...
             if (Auth::guard($guard)->check()) {
            return redirect('admin/director');
        }
                break;

                case 'Registrar':
                # code...
             if (Auth::guard($guard)->check()) {
            return redirect('admin/registrar');
        }
                break;
            case 'IPO':
                # code...
             if (Auth::guard($guard)->check()) {
            return redirect('admin/ipo');
        }
                break;

                case 'Vice President':
                # code...
             if (Auth::guard($guard)->check()) {
            return redirect('admin/vp');
        }
                break;
            
            default:
                # code...
             if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
                break;
        }
       

        return $next($request);
    }



}
