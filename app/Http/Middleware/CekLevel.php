<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CekLevel
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == 'Admin' || $user->level == 'Superadmin') {
                return $next($request);
            }
        }
        return redirect()->route('home');
    }
}
