<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('mahasiswa.index', compact('data'));
    }

    public function store(Request $request)
    {
        Mahasiswa::create($request->only('nama', 'nim'));
        return redirect()->back();
    }

    // ✅ Edit
    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    // ✅ Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim'  => 'required'
        ]);

        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update($request->only('nama','nim'));

        return redirect()->route('mahasiswa.index')->with('success','Data berhasil diupdate!');
    }

    // ✅ Delete
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->route('mahasiswa.index')->with('success','Data berhasil dihapus!');
    }

}
