<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SetUserTimezone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->timezone) {
            // Set default timezone PHP
            date_default_timezone_set(Auth::user()->timezone);

            // Set timezone Carbon (Laravel date handling)
            Carbon::setTimezone(Auth::user()->timezone);
        }
        return $next($request);
    }
}
