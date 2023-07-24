<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'kode_member' => 12345,
            'user_id' => 4,
            'nis' => 123123,
            'kelas_id' => 1,
            'jk' => 'Laki-Laki',
            'tempat_lahir' => 'Cilegon',
            'tanggal_lahir' => '1983-02-22',
            'alamat' => 'Jl.Perdamaian',
            'hp' => '08000000',
        ]);
    }
}
