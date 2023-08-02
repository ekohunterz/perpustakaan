<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar); // Menyimpan gambar di direktori "storage/app/public/foto"

            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/foto/' . $user->foto);
            }

            $user->foto = $namaGambar;
        }

        $user->save();

        // Jika user memiliki relasi staff, perbarui juga atribut pada staff
        if ($user->staff) {
            $user->staff->fill($request->validated());
            $user->staff->save();
        }

        if ($user->member) {
            $user->member->fill($request->validated());
            $user->member->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data diupdate'
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
