<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenantDomain
{
    /**
     * Handle an incoming request.
     * Detects custom domains and tenant subdomains, resolving the active tenant.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower($request->getHost());
        $centralDomains = ['localhost', '127.0.0.1', 'anemony.in', 'www.anemony.in'];

        $tenant = null;

        if (! in_array($host, $centralDomains, true)) {
            $cleanHost = preg_replace('/^www\./', '', $host);

            // 1. Check custom domains (e.g. bhupendra.online, toppersacademy.in)
            $tenant = Tenant::where(function ($query) use ($host, $cleanHost) {
                $query->where('custom_domain', $host)
                    ->orWhere('custom_domain', $cleanHost)
                    ->orWhere('custom_domain', 'www.'.$cleanHost);
            })->first();

            // 2. Check tenant subdomains (e.g. bbb-lcug.anemony.in or bbb-lcug.localhost)
            if (! $tenant) {
                if (str_ends_with($host, '.anemony.in')) {
                    $sub = explode('.', $host)[0];
                    $tenant = Tenant::where('slug', $sub)->first();
                } elseif (str_ends_with($host, '.localhost')) {
                    $sub = explode('.', $host)[0];
                    $tenant = Tenant::where('slug', $sub)->first();
                }
            }
        }

        if ($tenant) {
            app()->instance('current_tenant', $tenant);
            $request->attributes->set('tenant', $tenant);
        }

        return $next($request);
    }
}
