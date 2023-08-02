<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Kelas;
use App\Models\Visitor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([UserRoleSeeder::class]);
        $this->call([MemberSeeder::class]);
        $this->call([StaffSeeder::class]);
        $this->call([KepsekSeeder::class]);
        $this->call([SettingSeeder::class]);

        Book::factory(25)->create();
        Visitor::factory(25)->create();
        $this->call([CategorySeeder::class]);

        Kelas::create([
            'nama_kelas' => 'X TKJ 1'
        ]);
    }
}
