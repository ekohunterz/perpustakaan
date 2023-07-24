<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'kode_buku' => 12345,
            'nama_buku' => 'Judul Buku 1',
            'penerbit' => 'Penerbit 1',
            'th_terbit' => '2022',
            'isbn' => '978-1-234567-89-0',
            'kategori_id' => 1, // ID kategori yang sesuai
            'kondisi_buku_baik' => 10,
            'kondisi_buku_rusak' => 2,
            'stok_buku' => 12,
            'foto_buku' => 'nama-file-gambar.jpg',
        ]);
    }
}