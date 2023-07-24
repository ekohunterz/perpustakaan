<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\History;
use App\Models\Member;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create pengembalian peminjaman');;
    }

    public function index()
    {
        $member = new Member();
        $buku = Book::all();
        return view('pinjam.index', compact('member', 'buku'));
    }

    public function getMember(Request $request)
    {
        $kodeMember = $request->kode_member;

        // Cari member berdasarkan kode member
        $member = Member::with('user', 'kelas')->where('kode_member', $kodeMember)->first();

        $buku = Book::where('stok_buku', '>', 0)->orderBy('nama_buku', 'ASC')->get();
        return view('pinjam.proses-pinjam', compact('member', 'buku'));
    }

    public function store(Request $request)
    {
        $member = Pinjam::where('member_id', $request->member)->get();
        $count = $member->count();

        if ($count > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf member masih memiliki peminjaman buku'
            ]);
        }

        // Validasi data
        $request->validate([
            'buku1' => 'required',
            'kondisi_buku1' => 'required',
            'tgl_kembali' => 'required',
        ]);

        $tgl_kembali = $request->tgl_kembali;
        $books = [$request->buku1, $request->buku2, $request->buku3];
        $kondisi_buku = [$request->kondisi_buku1, $request->kondisi_buku2, $request->kondisi_buku3];

        // Loop untuk mengolah setiap buku yang dipinjam
        foreach ($books as $index => $book_id) {
            if (empty($book_id)) {
                continue; // Skip jika buku tidak dipilih
            }

            // Validasi kondisi buku jika buku dipilih
            $request->validate([
                'kondisi_buku' . ($index + 1) => 'required',
            ]);

            // Kurangi stok buku sesuai kondisi
            $book = Book::find($book_id);
            if ($kondisi_buku[$index] == "Baik") {
                if ($book->kondisi_buku_baik != 0) {
                    $book->decrement('kondisi_buku_baik');
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Stok Buku Sedang Kosong'
                    ]);
                }
            } else {
                if ($book->kondisi_buku_rusak != 0) {
                    $book->decrement('kondisi_buku_rusak');
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Stok Buku Sedang Kosong'
                    ]);
                }
            }

            // Buat peminjaman
            $pinjam = Pinjam::create([
                'member_id' => $request->member,
                'book_id' => $book_id,
                'tgl_pinjam' => date('Y-m-d'),
                'tgl_kembali' => $tgl_kembali,
                'kondisi_buku' => $kondisi_buku[$index],
            ]);


            History::create([
                'pinjam_id' => $pinjam->id,
                'member_id' => $request->member,
                'book_id' => $book_id,
                'tgl_pinjam' => date('Y-m-d'),
                'batas_tgl_kembali' => $tgl_kembali,
                'kondisi_buku_saat_dipinjam' => $kondisi_buku[$index],
                'status' => 'Pinjam'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Peminjaman Berhasil'
        ]);
    }
}
