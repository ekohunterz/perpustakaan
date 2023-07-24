<?php

namespace App\Http\Controllers;

use App\DataTables\HistoryDataTable;
use App\Models\History;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read laporan');
    }

    public function index(HistoryDataTable $dataTable)
    {
        return $dataTable->render('laporan.index');
    }

    public function show($id)
    {
        $pinjam = History::with('buku', 'member')->find($id);
        return view('laporan.modal-detail', compact('pinjam'));
    }

    public function cetak_filter(Request $request)
    {
        $dateRange = $request->date_range;
        if ($dateRange) {
            $data = explode(' to ', $dateRange);

            $startDate = date('Y-m-d', strtotime($data[0]));
            $endDate = date('Y-m-d', strtotime($data[1]));
            $riwayat = History::whereBetween('tgl_kembali', [$startDate, $endDate])
                ->get();
        } else {
            $dateRange = 'All';
            $riwayat = History::latest()->get();
        }

        $pdf = PDF::loadview('laporan.cetak', ['riwayat' => $riwayat]);
        return $pdf->download('Laporan-' . $dateRange . '.pdf');
        // return view('laporan.cetak', ['riwayat' => $riwayat]);
    }
}
