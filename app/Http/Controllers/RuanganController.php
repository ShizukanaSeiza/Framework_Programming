<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $data = Ruangan::all();
        return view('ruangan.index', compact('data'));
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:ruangan',
            'nama' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        Ruangan::create($request->only('kode','nama','kapasitas'));
        return redirect()->route('ruangan.index')->with('success','Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kode' => 'required|unique:ruangan,kode,'.$ruangan->id,
            'nama' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        $ruangan->update($request->only('kode','nama','kapasitas'));
        return redirect()->route('ruangan.index')->with('success','Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success','Ruangan berhasil dihapus.');
    }
}
