<?php

namespace App\Http\Controllers;

use App\DataTables\StaffDataTable;
use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin', 'permission:view|manage']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(StaffDataTable $dataTable)
    {
        return $dataTable->render('staff.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = new Staff();
        $staff->user = new User();
        return view('staff.modal-action', [
            'staff' => $staff
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
            'role' => 'staff',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar);
            $user->foto = $namaGambar;
        }
        $user->assignRole('staff');

        $user->save();

        $data['user_id'] = $user->id;

        $staff = Staff::create($data);

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
        $staff = Staff::with('user')->find($id);
        return view('staff.modal-detail', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        return view('staff.modal-action', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $staff = staff::with('user')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => ['required', Rule::unique('staff')->ignore($staff)],
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'status' => 'required|in:PNS,Honorer',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($staff->user_id)],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $staff->update($request->except('foto', 'name', 'email'));

        $staff->user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar); // Menyimpan gambar di direktori "storage/app/public/staffs"
            if ($staff->foto) {
                Storage::delete('public/foto/' . $staff->foto);
            }
            $staff->user->foto = $namaGambar;
            $staff->user->update([
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
        $staff = Staff::find($id);

        if ($staff) {
            if ($staff->user) {
                if ($staff->user->foto) {
                    Storage::delete('public/foto/' . $staff->user->foto);
                }
                $staff->user->delete();
            }
            $staff->delete();

            return response()->json(['message' => 'Data berhasil dihapus.']);
        }

        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
