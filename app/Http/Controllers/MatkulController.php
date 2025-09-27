<?php

namespace App\Http\Controllers;

use App\Models\matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        $data = matkul::all();
        return view('matkul.index',compact('data'));
    }
    public function store(Request $request)
    {
        matkul::create(
            $request->only('nama','keterangan'));
            return redirect()->back();
    }
}
