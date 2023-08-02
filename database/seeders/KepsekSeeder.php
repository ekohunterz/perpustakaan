<?php

namespace Database\Seeders;

use App\Models\Kepsek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepsekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kepsek = Kepsek::create([
            'user_id' => 3,
            'nip' => 123543,
            'jk' => 'Laki-Laki',
            'tempat_lahir' => 'Serang',
            'tanggal_lahir' => '1983-02-22',
            'alamat' => 'Jl.Jalan',
            'hp' => '081230000',
            'status' => 'PNS',
        ]);
    }
}
