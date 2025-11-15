<?php

namespace App\Http\Middleware;

use App\Models\Admin\License;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class LicenseCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $installed = Storage::disk('storage')->exists('installed');

        if ($installed == true) {
            $getLicense = License::first();
            if ($getLicense == null) {
                return redirect('/license-key');
            }
        }

        return $next($request);
    }
}
