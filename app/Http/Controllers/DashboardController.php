<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\History;
use App\Models\Kelas;
use App\Models\Member;
use App\Models\Pinjam;
use App\Models\Staff;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bulananPengunjung = Visitor::getMonthlyData();

        // Mengambil data jumlah pengunjung untuk setiap keperluan
        $visitorsBacaBuku = Visitor::where('keperluan', 'Baca Buku')->count();
        $visitorsPinjamBuku = Visitor::where('keperluan', 'Pinjam Buku')->count();
        $visitorsLainnya = Visitor::where('keperluan', 'Lainnya')->count();

        // Menghitung total pengunjung
        $totalVisitors = $visitorsBacaBuku + $visitorsPinjamBuku + $visitorsLainnya;

        // Menghitung persentase untuk masing-masing keperluan
        $persentaseBacaBuku = ($visitorsBacaBuku / $totalVisitors) * 100;
        $persentasePinjamBuku = ($visitorsPinjamBuku / $totalVisitors) * 100;
        $persentaseLainnya = ($visitorsLainnya / $totalVisitors) * 100;

        return view('dashboard.dashboard', [
            'jml_member' => Member::all()->count(),
            'jml_staff' => Staff::all()->count(),
            'jml_buku' => Book::all()->count(),
            'jml_kelas' => Kelas::all()->count(),
            'jml_pinjam' => Pinjam::all()->count(),
            'latest_member' => Member::latest()->limit(3)->get(),
            'latest_pinjam' => History::with('member.user', 'buku')->latest()->limit(5)->get(),
            'bulananLabels' => $bulananPengunjung['labels'],
            'bulananValues' => $bulananPengunjung['values'],
            'persentaseBaca' => $persentaseBacaBuku,
            'persentasePinjam' => $persentasePinjamBuku,
            'persentaseLainnya' => $persentaseLainnya,
        ]);
    }

    public function memberDashboard()
    {
        // Logika untuk dashboard siswa
        return view('dashboard.dashboardMember', [
            'latest_pinjam' => Pinjam::with('member.user', 'buku')->where('member_id', Auth::user()->member->id)->latest()->limit(5)->get(),
            'jml_pinjam' => Pinjam::where('member_id', Auth::user()->member->id)->get()->count(),
            'total_pinjam' => History::where('member_id', Auth::user()->member->id)->get()->count(),
            'jml_kunjungan' => Visitor::where('member_id', Auth::user()->member->id)->get()->count(),
            'latest_book' => Book::latest()->limit(5)->get(),
            'riwayat_kunjungan' => Visitor::with('member')->where('member_id', Auth::user()->member->id)->latest()->limit(5)->get(),
        ]);
    }
}
