<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{
    public function index()
    {
        $settings = LandingSetting::orderBy('key')->get();
        return view('admin.landing.settings.index', compact('settings'));
    }

    public function edit($id)
    {
        $setting = LandingSetting::findOrFail($id);
        return view('admin.landing.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = LandingSetting::findOrFail($id);

        if ($setting->type === 'image') {
            $request->validate(['value' => 'image|mimes:jpg,png,webp,svg|max:2048']);
            $path = $request->file('value')->store('landing', 'public');
            $setting->value = $path;
        } else {
            $request->validate(['value' => 'required']);
            $setting->value = $request->value;
        }

        $setting->save();
        return redirect()->route('admin.landing.settings.index')->with('success', 'Setting updated successfully');
    }
}
