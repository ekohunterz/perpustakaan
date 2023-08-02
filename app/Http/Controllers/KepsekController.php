<?php

namespace App\Http\Controllers;

use App\DataTables\KepsekDataTable;
use App\Models\Kepsek;
use App\Http\Requests\StoreStaffRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KepsekController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin', 'permission:view|manage']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(KepsekDataTable $dataTable)
    {
        return $dataTable->render('kepsek.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kepsek = new Kepsek();
        $kepsek->user = new User();
        return view('kepsek.modal-action', [
            'kepsek' => $kepsek
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        $data = $request->except('name', 'email', 'foto');

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->nip),
            'role' => 'kepsek',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar);
            $user->foto = $namaGambar;
        }
        $user->assignRole('kepsek');

        $user->save();

        $data['user_id'] = $user->id;

        $kepsek = Kepsek::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data ditambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kepsek = Kepsek::with('user')->find($id);
        return view('kepsek.modal-detail', compact('kepsek'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kepsek = Kepsek::find($id);
        return view('kepsek.modal-action', compact('kepsek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kepsek = Kepsek::with('user')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => ['required', Rule::unique('kepsek')->ignore($kepsek)],
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'status' => 'required|in:PNS,Honorer',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($kepsek->user_id)],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kepsek->update($request->except('foto', 'name', 'email'));

        $kepsek->user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar); // Menyimpan gambar di direktori "storage/app/public/kepseks"
            if ($kepsek->foto) {
                Storage::delete('public/foto/' . $kepsek->foto);
            }
            $kepsek->user->foto = $namaGambar;
            $kepsek->user->update([
                'foto' => $namaGambar
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $kepsek = Kepsek::find($id);

        if ($kepsek) {
            if ($kepsek->user) {
                if ($kepsek->user->foto) {
                    Storage::delete('public/foto/' . $kepsek->user->foto);
                }
                $kepsek->user->delete();
            }
            $kepsek->delete();

            return response()->json(['message' => 'Data berhasil dihapus.']);
        }

        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
