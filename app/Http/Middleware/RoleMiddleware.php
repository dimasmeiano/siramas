<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
         $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Cek apakah user punya salah satu role yang diberikan
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized: Anda tidak memiliki akses.');
    }
}
