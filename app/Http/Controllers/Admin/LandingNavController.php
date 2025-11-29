<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingNavLink;
use Illuminate\Http\Request;

class LandingNavController extends Controller
{
    public function index()
    {
        $items = LandingNavLink::orderBy('position')->get();
        return view('admin.landing.nav.index', compact('items'));
    }

    public function create()
    {
        return view('admin.landing.nav.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'url' => 'required',
            'position' => 'required|integer',
        ]);

        LandingNavLink::create($request->all());
        return redirect()->route('admin.landing.navigation.index')->with('success', 'Menu created');
    }

    public function edit($id)
    {
        $item = LandingNavLink::findOrFail($id);
        return view('admin.landing.nav.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = LandingNavLink::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.landing.navigation.index')->with('success', 'Menu updated');
    }

    public function destroy($id)
    {
        LandingNavLink::destroy($id);
        return back()->with('success', 'Menu deleted');
    }
}

