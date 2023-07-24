<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'nama_sekolah' => 'SMK 4 Kota Serang',
            'alamat_sekolah' => 'Jl.Petir',
            'kota' => 'Serang',
            'provinsi' => 'Banten',
            'telp' => '000123',
            'email' => 'asd@gmail.ac.id',
            'logo' => '',
            'denda_terlambat' => 1000,
            'denda_rusak' => 20000,
            'denda_hilang' => 50000,
        ]);
    }
}
