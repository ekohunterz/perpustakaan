<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::first();
        $setting->update($request->except('logo'));
        // Proses upload logo jika ada
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $namaGambar = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('public/logos', $namaGambar);
            if ($setting->logo) {
                Storage::delete('public/logos/' . $setting->logo);
            }
            $setting->logo = $namaGambar;
            // Simpan perubahan data setting
            $setting->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data diupdate'
        ]);
    }

    public function updateDenda(Request $request)
    {
        $setting = Setting::first();

        $request->validate([
            'denda_terlambat' => 'required|numeric',
            'denda_rusak' => 'required|numeric',
            'denda_hilang' => 'required|numeric',
        ]);

        $setting->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data diupdate'
        ]);
    }
}
