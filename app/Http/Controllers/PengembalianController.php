<?php

namespace App\Http\Controllers;

use App\DataTables\PeminjamanDataTable;
use App\Models\Book;
use App\Models\History;
use App\Models\Member;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:staff']);
    }

    public function index(PeminjamanDataTable $dataTable)
    {
        $member = new Member();
        $buku = Book::all();
        return $dataTable->render('pengembalian.index', compact('member', 'buku'));
    }

    public function getMember(Request $request)
    {
        $kodeMember = $request->kode_member;

        // Cari member berdasarkan kode member
        $member = Member::with('user', 'kelas')->where('kode_member', $kodeMember)->first();

        $pinjam = Pinjam::with('member', 'buku')->where('member_id', $member->id)->get();
        return view('pengembalian.proses-pengembalian', compact('member', 'pinjam'));
    }

    public function ProsesPengembalian($id)
    {
        $pinjam = Pinjam::find($id);
        return view('pengembalian.modal-action', compact('pinjam'));
    }

    public function store(Request $request, $id)
    {
        $denda = $request->denda;
        $tgl_kembali = $request->tgl_kembali;
        $kondisi_buku = $request->kondisi_buku_saat_dikembalikan;
        $riwayat = History::where('pinjam_id', $id)->first();
        $id_buku = $riwayat->book_id;
        Book::find($id_buku)->increment('kondisi_buku_baik');

        History::where('pinjam_id', $id)->update([
            'denda' => $denda,
            'tgl_kembali' => $tgl_kembali,
            'kondisi_buku_saat_dikembalikan' => $kondisi_buku,
            'status' => 'Selesai',
        ]);


        Pinjam::find($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pengembalian Buku Berhasil!'
        ]);
    }
}