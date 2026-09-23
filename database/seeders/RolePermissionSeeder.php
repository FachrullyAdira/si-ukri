<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles (Spatie Permission)
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminAkademikRole = Role::firstOrCreate(['name' => 'Admin Akademik', 'guard_name' => 'web']);
        $editorKontenRole = Role::firstOrCreate(['name' => 'Editor Konten', 'guard_name' => 'web']);
        $adminMhsRole = Role::firstOrCreate(['name' => 'Admin Kemahasiswaan', 'guard_name' => 'web']);
        
        // LMS Roles
        $dosenRole = Role::firstOrCreate(['name' => 'Dosen', 'guard_name' => 'web']);
        $mahasiswaRole = Role::firstOrCreate(['name' => 'Mahasiswa', 'guard_name' => 'web']);

        // Create Sample Users for each Role
        
        // 1. Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@ukri.ac.id'],
            ['name' => 'Super Admin SI UKRI', 'password' => Hash::make('password')]
        );
        $superAdmin->assignRole($superAdminRole);

        // 2. Admin Akademik
        $adminAkademik = User::firstOrCreate(
            ['email' => 'akademik@ukri.ac.id'],
            ['name' => 'Admin Akademik Prodi', 'password' => Hash::make('password')]
        );
        $adminAkademik->assignRole($adminAkademikRole);

        // 3. Editor Konten
        $editorKonten = User::firstOrCreate(
            ['email' => 'humas@ukri.ac.id'],
            ['name' => 'Humas & Editor Konten', 'password' => Hash::make('password')]
        );
        $editorKonten->assignRole($editorKontenRole);

        // 4. Admin Kemahasiswaan
        $adminMhs = User::firstOrCreate(
            ['email' => 'kemahasiswaan@ukri.ac.id'],
            ['name' => 'Admin Kemahasiswaan', 'password' => Hash::make('password')]
        );
        $adminMhs->assignRole($adminMhsRole);

        // 5. Dosen
        $dosen = User::firstOrCreate(
            ['email' => 'dosen@ukri.ac.id'],
            ['name' => 'Dosen Pengajar LMS', 'password' => Hash::make('password')]
        );
        $dosen->assignRole($dosenRole);

        // 6. Mahasiswa
        $mahasiswa = User::firstOrCreate(
            ['email' => 'mahasiswa@ukri.ac.id'],
            ['name' => 'Mahasiswa SI', 'password' => Hash::make('password')]
        );
        $mahasiswa->assignRole($mahasiswaRole);
    }
}
