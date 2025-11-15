<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // 🔹 Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        // Ambil data eKYC milik user yang login
        $ekyc = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();

        if ($ekyc && $ekyc->status === 'submitted') {
            // Jika eKYC sudah selesai
            return redirect()->route('ekyc.step5');
        } else {
            // Jika belum ada atau belum selesai
            return redirect()->route('ekyc.step1');
        }

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
