<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            $ip = $request->ip();
            $date = now()->format('Y-m-d');
            $path = $request->path();

            if (!$request->ajax() && !str_starts_with($path, 'livewire') && !str_starts_with($path, 'api')) {
                $hasVisited = \App\Models\KunjunganSitus::where('ip_address', $ip)
                    ->where('tanggal', $date)
                    ->exists();

                if (!$hasVisited) {
                    \App\Models\KunjunganSitus::create([
                        'ip_address' => $ip,
                        'user_agent' => $request->userAgent(),
                        'path' => $path,
                        'tanggal' => $date,
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Ignore DB errors
        }

        return $response;
    }
}
