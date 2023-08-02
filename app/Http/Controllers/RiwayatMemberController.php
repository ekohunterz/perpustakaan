<?php

namespace App\Http\Controllers;

use App\DataTables\HistoryMemberDataTable;
use Illuminate\Http\Request;

class RiwayatMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:siswa']);
    }

    public function index(HistoryMemberDataTable $dataTable)
    {
        return $dataTable->render('riwayatMember.index');
    }
}
