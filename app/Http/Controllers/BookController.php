<?php

namespace App\Http\Controllers;

use App\DataTables\BookDataTable;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:create')->only('create', 'store');
        $this->middleware('can:update')->only('update', 'edit');
        $this->middleware('can:delete')->only('destroy');
    }


    public function index(BookDataTable $dataTable)
    {
        return $dataTable->render('book.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.modal-action', [
            'book' => new Book(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $buku = Book::create($request->all());

        if ($request->hasFile('foto_buku')) {
            $gambar = $request->file('foto_buku');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('public/books', $namaGambar); // Menyimpan gambar di direktori "storage/app/public/books"
            $buku->foto_buku = $namaGambar;
            $buku->save(); // Menyimpan nama gambar ke dalam database
        }

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
        $book = Book::find($id);
        return view('book.modal-detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('book.modal-action', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->update($request->except('foto_buku'));
        if ($request->hasFile('foto_buku')) {
            $foto_buku = $request->file('foto_buku');
            $namaGambar = time() . '_' . $foto_buku->getClientOriginalName();
            $foto_buku->storeAs('public/books', $namaGambar); // Menyimpan gambar di direktori "storage/app/public/books"
            if ($book->foto_buku) {
                Storage::delete('public/books/' . $book->foto_buku);
            }
            $book->foto_buku = $namaGambar;
            $book->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data diupdate'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($book)
    {
        $data = Book::find($book);

        if ($data->foto_buku) {
            Storage::delete('public/books/' . $data->foto_buku);
        }

        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data dihapus'
        ]);
    }
}
