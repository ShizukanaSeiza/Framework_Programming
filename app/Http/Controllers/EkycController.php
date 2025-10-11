<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkycRegistration;
use Illuminate\Support\Facades\Auth;

class EkycController extends Controller
{
    public function step1()
    {
        // Ambil data draft user jika sudah ada
        $ekyc = EkycRegistration::where('user_id', Auth::id())
                ->where('status', 'draft')
                ->first();

        // Simpan session agar bisa lanjut ke step berikutnya
        if ($ekyc) {
            session(['ekyc_id' => $ekyc->id]);
        }

        return view('ekyc.step1', compact('ekyc'));
    }
    public function storeStep1(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        $ekyc = EkycRegistration::updateOrCreate(
            [
                'id' => session('ekyc_id'),
                'user_id' => Auth::id(),
            ],
            [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'status' => 'draft',
            ]
        );

        session(['ekyc_id' => $ekyc->id]);

        return redirect()->route('ekyc.step2')->with('succes', 'Data pribadi disimpan, lanjut ke langkah berikutnya.');
    }
}
