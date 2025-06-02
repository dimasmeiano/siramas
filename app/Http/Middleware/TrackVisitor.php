<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Illuminate\Support\Carbon;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // Abaikan jika akses file statis
        if (preg_match('/\.(jpg|jpeg|png|gif|svg|css|js|ico|woff2?|ttf|eot)$/i', $path)) {
            return $next($request);
        }

        // Abaikan admin atau API jika perlu
        if ($request->is('admin/*') || $request->is('api/*') || $request->is('storage/*')) {
            return $next($request);
        }

         // Cek jika sudah ada log dengan IP & URL hari ini
            $ip = $request->ip();
            $url = $request->url();

            $alreadyLogged = \App\Models\Visitor::where('ip', $ip)
                ->where('url', $url)
                ->whereDate('visited_at', now()->toDateString())
                ->exists();

        if (!$alreadyLogged) {
            \App\Models\Visitor::create([
                'ip' => $ip,
                'url' => $url,
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}