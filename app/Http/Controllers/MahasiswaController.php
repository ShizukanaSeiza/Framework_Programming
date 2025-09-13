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
}
