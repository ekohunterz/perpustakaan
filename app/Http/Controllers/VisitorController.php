<?php

namespace App\Http\Controllers;

use App\DataTables\VisitorDataTable;
use App\Models\Member;
use App\Models\Visitor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:staff|kepsek'])->only('laporan', 'cetak');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(VisitorDataTable $dataTable)
    {
        return $dataTable->render('home.pengunjung');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function laporan(VisitorDataTable $dataTable)
    {
        return $dataTable->render('pengunjung.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // Cek apakah pengunjung adalah member atau bukan
        $isMember = $request->flexRadioDefault === 'member';

        if ($isMember) {
            $request->validate([
                'nis' => 'required|string|max:20',
                'keperluan' => 'required|string|max:255',
            ]);
            $member = Member::with('user', 'kelas')->where('nis', $request->nis)->first();
            if (!$member) {
                return response()->json(['status' => 'error', 'message' => 'Nis tidak ditemukan']);
            }

            Visitor::create([
                'nama' => $member->user->name,
                'kelas' => $member->kelas->nama_kelas,
                'nis' => $request->nis,
                'keperluan' => $request->keperluan,
                'member_id' => $member->id
            ]);
        } else {
            $request->validate([
                'nis' => 'required|string|max:20',
                'keperluan' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'kelas' => 'required|string|max:255',
            ]);

            Visitor::create([
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'nis' => $request->nis,
                'keperluan' => $request->keperluan,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function cetak(Request $request)
    {
        $dateRange = $request->date_range;
        if ($dateRange) {
            $data = explode(' to ', $dateRange);

            $startDate = date('Y-m-d', strtotime($data[0]));
            if (isset($data[1])) {
                $endDate = date('Y-m-d', strtotime($data[1]));
                $visitor = Visitor::whereBetween('created_at', [$startDate, $endDate])->get();
            } else {
                $visitor = Visitor::whereDate('created_at', $startDate)->get();
            }
        } else {
            $dateRange = 'All';
            $visitor = Visitor::latest()->get();
        }

        $pdf = PDF::loadview('pengunjung.cetak', ['visitor' => $visitor]);
        return $pdf->download('LaporanPengunjung-' . $dateRange . '.pdf');
        // return view('pengunjung.cetak', ['visitor' => $visitor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
