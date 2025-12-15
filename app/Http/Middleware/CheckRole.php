<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (! auth()->check()) {
            $request->session()->put('nextURL', url()->current());
            return redirect('login')->with('error', 'Anda belum login.');
        }

        $user = auth()->user();

        if (! in_array($user->role, $roles)) {
            return redirect('login')->with('warning', 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
