<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Tampilkan daftar dosen.
     */
    public function index()
    {
        $data = Dosen::all();
        return view('dosen.index', compact('data'));
    }

    /**
     * Simpan dosen baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nid'  => 'required|string|max:50|unique:dosen,nid',
            'alamat' => 'nullable|string|max:255',
            'mata_kuliah' => 'nullable|string|max:100',
        ]);

        Dosen::create($request->only(['nama','nid','alamat','mata_kuliah']));

        return redirect()->route('dosen.index')
                         ->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Form edit dosen.
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update data dosen.
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'nid'  => 'required|string|max:50|unique:dosen,nid,' . $dosen->id,
            'alamat' => 'nullable|string|max:255',
            'mata_kuliah' => 'nullable|string|max:100',
        ]);

        $dosen->update($request->only(['nama','nid','alamat','mata_kuliah']));

        return redirect()->route('dosen.index')
                         ->with('success', 'Data dosen berhasil diupdate.');
    }

    /**
     * Hapus dosen.
     */
    public function destroy($id)
    {
        Dosen::destroy($id);
        return redirect()->route('dosen.index')
                         ->with('success', 'Dosen berhasil dihapus.');
    }
}
