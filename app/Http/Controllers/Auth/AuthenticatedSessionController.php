<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        // cek percobaan login bia ga kena brute force
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam $seconds detik.",
            ])->withInput();
        }

        $remember = $request->has('remember');

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            // kalo udah login, ga usah di rate limit lagi
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();

            $loggedInUserRole = $request->user()->role;

            if ($loggedInUserRole == 'admin') {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            } elseif ($loggedInUserRole == 'operator') {
                return redirect()->intended(route('operator.dashboard', absolute: false));
            }
            return redirect()->intended(route('siswa.dashboard', absolute: false));
        }

        // hit berapa kali percobaan gagal
        RateLimiter::hit($throttleKey);

        return back()->withErrors([
            'email' => __('Email atau password tidak sesuai.'),
        ])->withInput();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
