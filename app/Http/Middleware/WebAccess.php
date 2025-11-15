<?php

namespace App\Http\Middleware;

use App\Models\InternalSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $settings = InternalSetting::first(['frontend']);

        if ($settings->frontend == 'no') {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
