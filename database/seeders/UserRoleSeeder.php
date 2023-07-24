<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            $admin = User::create(array_merge([
                'email' => 'admin@gmail.com',
                'name' => 'admin',
                'role' => 'admin'
            ], $default_user_value));

            $staff = User::create(array_merge([
                'email' => 'staff@gmail.com',
                'name' => 'staff',
                'role' => 'staff'
            ], $default_user_value));

            $kepsek = User::create(array_merge([
                'email' => 'kepsek@gmail.com',
                'name' => 'kepsek',
                'role' => 'kepsek'
            ], $default_user_value));

            $siswa = User::create(array_merge([
                'email' => 'siswa@gmail.com',
                'name' => 'siswa',
                'role' => 'siswa'
            ], $default_user_value));

            $role_admin = Role::create(['name' => 'admin']);
            $role_staff = Role::create(['name' => 'staff']);
            $role_kepsek = Role::create(['name' => 'kepsek']);
            $role_siswa = Role::create(['name' => 'siswa']);

            $permission = Permission::create(['name' => 'read']);
            $permission = Permission::create(['name' => 'create']);
            $permission = Permission::create(['name' => 'update']);
            $permission = Permission::create(['name' => 'delete']);

            $permission = Permission::create(['name' => 'create staff']);
            $permission = Permission::create(['name' => 'update staff']);
            $permission = Permission::create(['name' => 'delete staff']);
            $permission = Permission::create(['name' => 'create pengembalian peminjaman']);
            $permission = Permission::create(['name' => 'read pengembalian peminjaman']);
            $permission = Permission::create(['name' => 'read laporan']);
            // $permission = Permission::create(['name' => 'read category']);
            // $permission = Permission::create(['name' => 'create category']);
            // $permission = Permission::create(['name' => 'update category']);
            // $permission = Permission::create(['name' => 'delete category']);

            // $role_admin->givePermissionTo(['read book', 'create book', 'update book', 'delete book', 'read category', 'create category', 'update category', 'delete category']);
            // $role_staff->givePermissionTo(['read book', 'create book', 'update book', 'delete book', 'read category', 'create category', 'update category', 'delete category']);
            // $role_kepsek->givePermissionTo(['read book', 'read category']);
            // $role_siswa->givePermissionTo(['read book']);

            $role_admin->givePermissionTo(['read', 'create', 'update', 'delete',  'delete staff', 'create staff', 'update staff']);
            $role_staff->givePermissionTo(['read', 'create', 'update', 'delete', 'read laporan', 'create pengembalian peminjaman', 'read pengembalian peminjaman']);
            $role_kepsek->givePermissionTo(['read', 'read laporan']);
            // $role_siswa->givePermissionTo(['read']);



            $admin->assignRole('admin');
            $staff->assignRole('staff');
            $kepsek->assignRole('kepsek');
            $siswa->assignRole('siswa');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
