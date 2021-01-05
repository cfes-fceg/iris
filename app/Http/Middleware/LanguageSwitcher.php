<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('locale')) {
            if(\Auth::user())
                Session::put('locale', \Auth::user()->language);
            else
                Session::put('locale', Config::get('app.locale'));
        }
        App::setLocale(session('locale'));
        return $next($request);
    }
}
