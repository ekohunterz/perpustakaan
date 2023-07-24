<?php

namespace App\Http\Controllers;

use App\DataTables\MemberDataTable;
use App\Models\Member;
use App\Http\Requests\MemberRequest;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:create')->only('create', 'store');
        $this->middleware('can:update')->only('update', 'edit');
        $this->middleware('can:delete')->only('destroy');
        $this->middleware('can:read')->only('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(MemberDataTable $dataTable)
    {
        return $dataTable->render('member.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $member = new Member();
        $member->user = new User();
        return view('member.modal-action', [
            'member' => $member,
            'kelas' => Kelas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        $data = $request->except('name', 'email', 'foto');

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->nis),
            'role' => 'siswa',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar);
            $user->foto = $namaGambar;
        }
        $user->assignRole('siswa');

        $user->save();

        $data['user_id'] = $user->id;

        $member = Member::create($data);

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
        $member = Member::with('user', 'kelas')->find($id);
        return view('member.modal-detail', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $kelas = Kelas::all();
        return view('member.modal-action', compact('member', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member = Member::with('user')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'kode_member' => ['required', Rule::unique('members')->ignore($member)],
            'nis' => ['required', Rule::unique('members')->ignore($member)],
            'kelas_id' => 'required',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($member->user_id)],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $member->update($request->except('foto', 'name', 'email'));

        $member->user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaGambar = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $namaGambar); // Menyimpan gambar di direktori "storage/app/public/members"
            if ($member->foto) {
                Storage::delete('public/foto/' . $member->foto);
            }
            $member->user->foto = $namaGambar;
            $member->user->update([
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
        $member = Member::find($id);

        // Jika member ditemukan
        if ($member) {
            // Hapus member terkait jika ada
            if ($member->user) {
                if ($member->user->foto) {
                    Storage::delete('public/foto/' . $member->user->foto);
                }
                $member->user->delete();
            }

            // Hapus member
            $member->delete();

            // Berikan respons sukses
            return response()->json(['message' => 'Data berhasil dihapus.']);
        }

        // Jika user tidak ditemukan
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function generateKodeMember()
    {
        $uniqueCode = '';

        do {
            // Logika untuk menghasilkan kode member unik
            $uniqueCode = 'KD-' . Str::random(6);
        } while (Member::where('kode_member', $uniqueCode)->exists());

        return response()->json(['kode_member' => $uniqueCode]);
    }
}
