<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $data = dosen::all();
        return view('dosen.index',compact('data'));
    }
    public function store(Request $request)
    {
        matkul::create(
            $request->only('nama','nid'));
            return redirect()->back();
    }
}
