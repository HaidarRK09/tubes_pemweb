<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPasien
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan guard yang digunakan adalah "pasiens"
        if (Auth::guard('pasiens')->check()) {
            // Jika pengguna otentikasi menggunakan guard "pasiens", lanjutkan ke permintaan berikutnya
            return $next($request);
        }

        // Jika tidak, redirect pengguna ke halaman yang sesuai
        return redirect()->route('pasien.login.form')->with('error', 'Unauthorized access');

    }
}
