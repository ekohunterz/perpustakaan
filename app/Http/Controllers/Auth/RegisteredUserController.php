<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->except('foto');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'kode_member' => ['required', Rule::unique('members')->ignore($request->user_id)],
            'nis' => ['required', Rule::unique('members')->ignore($request->user_id)],
            'kelas_id' => 'required',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar);
            $user->foto = $namaGambar;
        }
        $user->assignRole('siswa');

        $user->role = 'siswa';


        $user->save();
        $data['user_id'] = $user->id;

        $member = Member::create($data);

        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi Berhasil'
        ]);
    }
}
