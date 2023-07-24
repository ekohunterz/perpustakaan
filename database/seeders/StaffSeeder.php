<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = Staff::create([
            'user_id' => 2,
            'nip' => 123123,
            'jk' => 'Laki-Laki',
            'tempat_lahir' => 'Cilegon',
            'tanggal_lahir' => '1983-02-22',
            'alamat' => 'Jl.Perdamaian',
            'hp' => '08000000',
            'status' => 'PNS',
        ]);
    }
}
