<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Tampilkan daftar mata kuliah.
     */
    public function index()
    {
        $data = Matkul::all();
        return view('matkul.index', compact('data'));
    }

    /**
     * Simpan mata kuliah baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kode' => 'required|string|max:50|unique:matkul,kode',
            'sks'  => 'required|integer|min:1|max:6',
        ]);

        Matkul::create($request->only(['nama','kode','sks']));

        return redirect()->route('matkul.index')
                         ->with('success', 'Matkul berhasil ditambahkan.');
    }

    /**
     * Form edit matkul.
     */
    public function edit($id)
    {
        $matkul = Matkul::findOrFail($id);
        return view('matkul.edit', compact('matkul'));
    }

    /**
     * Update data matkul.
     */
    public function update(Request $request, $id)
    {
        $matkul = Matkul::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'kode' => 'required|string|max:50|unique:matkul,kode,' . $matkul->id,
            'sks'  => 'required|integer|min:1|max:6',
        ]);

        $matkul->update($request->only(['nama','kode','sks']));

        return redirect()->route('matkul.index')
                         ->with('success', 'Data matkul berhasil diupdate.');
    }

    /**
     * Hapus matkul.
     */
    public function destroy($id)
    {
        Matkul::destroy($id);
        return redirect()->route('matkul.index')
                         ->with('success', 'Matkul berhasil dihapus.');
    }
}
