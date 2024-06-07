<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
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
        $username = 'guru';
        $password = 'guru';

        if ($request->session()->has('logged_in') && $request->session()->get('logged_in') === true) {
            return $next($request);
        }

        if ($request->isMethod('post') && $request->path() === 'login') {
            if ($request->input('email') === $username && $request->input('password') === $password) {
                $request->session()->put('logged_in', true);
                return redirect()->route('dashboard');
            } else {
                return redirect('/login')->withErrors(['login' => 'Invalid credentials']);
            }
        }

        return redirect('/login');
    }
}
