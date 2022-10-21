<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Status
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
        $next = view('home');
        if (auth()->user()->Status == 'مفعل') {
            //return $next($request);
            return view('/home');
        }else{
            return redirect()->back()->with('meassge','تم انتهاء اصلحية');
        }
       // return response()->json('Your account is inactive');

    //   return $next($request);
    
    }
}
