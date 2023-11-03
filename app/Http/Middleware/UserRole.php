<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        $module = explode('.',$request->route()->getName());
        if(count($module) > 0){
            if($module[0] == 'student_alumni' && in_array(Auth::user()->role , ['student' , 'alumni', 'lecturer'])){
                //echo 'b=>' .Auth::user()->role; exit;
                return $next($request);
            }
            if(Auth::user()->role != 'admin'){
                if(Auth::user()->role != $module[0]){
                    // echo 'b=>' .Auth::user()->role; exit;
                    // Auth::guard('web')->logout();
                    // $request->session()->invalidate();
                    // $request->session()->regenerateToken();
                    
                    return redirect('/login');
    
                }
            }
            
        }
        
        return $next($request);
    }
}
