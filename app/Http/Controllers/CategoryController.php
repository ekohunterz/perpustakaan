<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;

use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create')->only('create', 'store');
        $this->middleware('can:read')->only('index');
        $this->middleware('can:update')->only('update', 'edit');
        $this->middleware('can:delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.modal-action', ['kategori' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = Category::find($id);
        return view('kategori.modal-action', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

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
        $data = Category::find($id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data dihapus'
        ]);
    }
}
