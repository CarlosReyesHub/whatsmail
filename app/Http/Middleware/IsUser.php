<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config; 

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $emailSettings  = Setting::withoutGlobalScopes()->where("merchant_id", null)->first(['timezone','default_lang']);
        $userSetting    = null; 

        if (auth()->check()) {
            $userSetting = Setting::withoutGlobalScopes()->where('merchant_id', auth()->user()->merchant_id)->first(['timezone', 'default_lang']);
        }

        if ($userSetting) {
            Config::set('app.timezone', $userSetting->timezone);
            Config::set('app.locale', $userSetting->default_lang);
        } else {
            if ($emailSettings) {
                Config::set('app.timezone', $emailSettings->timezone);
                Config::set('app.locale', $emailSettings->default_lang);
            }
        }
        return auth()->check() ?
            $next($request) :
            redirect()->route('login');
    }
}
