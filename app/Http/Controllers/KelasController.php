<?php

namespace App\Http\Controllers;

use App\DataTables\KelasDataTable;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelasController extends Controller
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
    public function index(KelasDataTable $dataTable)
    {
        return $dataTable->render('kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.modal-action', [
            'kelas' => new Kelas(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelas' => [
                'required',
                Rule::unique('kelas'),
            ],
        ]);

        Kelas::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Data ditambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('kelas.modal-action', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $validatedData = $request->validate([
            'nama_kelas' => [
                'required',
                Rule::unique('kelas')->ignore($kelas),
            ],
        ]);
        $kelas->update($validatedData);

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
        $data = Kelas::find($id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data dihapus'
        ]);
    }
}
