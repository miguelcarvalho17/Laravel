<?php

namespace App\Http\Middleware;

use DebugBar\DebugBar;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        Debugbar::info(Auth::user()->isCompany());
        if (Auth::user()->isCompany()){
            return route('companyHome');
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
