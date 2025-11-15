<?php

namespace App\Http\Middleware;

use App\Models\Merchant\Merchant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackageActivation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'user') {
                $merchant    = Merchant::where("id", auth()->user()->merchant_id)->first(['id', 'status']);

                if ($merchant) {

                    if ($merchant->status == 'no') {
                        return redirect()->route('starter.packages')->with(['gagal' => __('starter.business_not_active')]);
                    }

                    if ($merchant->package_active) {
                        return $next($request);
                    }
                }

                return redirect()->route('starter.packages')->with(['gagal' => __('starter.package_plan_desc')]);
            }
        }

        return $next($request);
    }
}
