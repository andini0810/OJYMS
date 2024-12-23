<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Cek status user
        if ($user->status === 'nonaktif') {
            // Jika status non-aktif, hanya izinkan akses ke route pengisian form
            if (!in_array($request->route()->getName(), ['form', 'form.update'])) {
                return redirect()->route('form')->with('error', 'Your account is inactive. Please complete your profile.');
            }
        }

        return $next($request);
    }
}
