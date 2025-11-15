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

    // 🔹 Jika Admin → langsung ke dashboard
    if ($user->role === 'admin') {
        return redirect()->route('dashboard');
    }

    // 🔹 Ambil data eKYC milik user
    $ekyc = \App\Models\EkycRegistration::where('user_id', $user->id)->first();

    // 🔹 Jika data eKYC ditemukan, buat notifikasi status
    if ($ekyc) {
        $status = strtolower($ekyc->status);

        if ($status === 'accepted') {
            session()->flash('ekyc_status', [
                'type' => 'success',
                'message' => 'Registrasi eKYC Anda telah diterima (ACCEPTED).'
            ]);
        } elseif ($status === 'rejected') {
            session()->flash('ekyc_status', [
                'type' => 'error',
                'message' => 'Registrasi eKYC Anda ditolak (REJECTED). Silakan perbaiki data.'
            ]);
        } elseif ($status === 'submitted') {
            session()->flash('ekyc_status', [
                'type' => 'info',
                'message' => 'Registrasi eKYC Anda sedang diproses (SUBMITTED).'
            ]);
        } elseif ($status === 'draft') {
            session()->flash('ekyc_status', [
                'type' => 'warning',
                'message' => 'Anda belum menyelesaikan registrasi eKYC (DRAFT).'
            ]);
        }
    }

    // 🔹 Redirect ke halaman sesuai status
    if ($ekyc && $ekyc->status !== 'draft') {
        return redirect()->route('ekyc.step5');
    } else {
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