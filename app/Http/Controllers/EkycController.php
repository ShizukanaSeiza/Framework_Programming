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

    public function step2()
    {
        $data = EkycRegistration::where('user_id', auth()->id())->first();
        return view('ekyc.step2', compact('data'));
    }

    public function storeStep2(Request $request)
    {
        $validate = $request->validate([
            'file_ktp' => 'nullable|image|mimes:jpg,jpeg,png|required|max:2048',
            'file_selfie' => 'nullable|image|mimes:jpg,jpeg,png|required|max:2048',
        ]);

        $ekyc = EkycRegistration::firstOrCreate(['user_id' => auth()->id()]);

        if ($request->hasFile('file_ktp')) {
            $validate['file_ktp'] = $request->file('file_ktp')->store('ekyc', 'public');
        }

        if ($request->hasFile('file_selfie')) {
            $validate['file_selfie'] = $request->file('file_selfie')->store('ekyc', 'public');
        }

        $ekyc->update($validate);

       return redirect()->route('ekyc.step3')->with('success', 'Step 2 tersimpan.');
    }

    public function showStep3()
    {
        $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();
        return view('ekyc.step3', compact('data'));
    }
    public function storeStep3(Request $request)
    {
        $request->validate([
            'asal_sd' => 'required|string|max:255',
            'asal_smp' => 'required|string|max:255',
            'asal_sma' => 'required|string|max:255',
            'file_kk' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ijazah' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

       $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();

        $data->asal_sd = $request->asal_sd;
        $data->asal_smp = $request->asal_smp;
        $data->asal_sma = $request->asal_sma;   

        if ($request->hasFile('file_kk')) {
            $data->file_kk = $request->file('file_kk')->store('ekyc', 'public');
        }

        if ($request->hasFile('file_ijazah')) {
            $data->file_ijazah = $request->file('file_ijazah')->store('ekyc', 'public');
        }

        $data->save();

        return redirect()->route('ekyc.step3')->with('success', 'Data pendidikan berhasil disimpan.');
    }
}