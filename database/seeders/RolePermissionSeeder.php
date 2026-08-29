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

        // Create Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminKontenRole = Role::firstOrCreate(['name' => 'Admin Konten', 'guard_name' => 'web']);
        $editorBeritaRole = Role::firstOrCreate(['name' => 'Editor Berita', 'guard_name' => 'web']);

        // Create Sample Users
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@ukri.ac.id'],
            [
                'name' => 'Super Admin SI UKRI',
                'password' => Hash::make('password'),
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        $adminKonten = User::firstOrCreate(
            ['email' => 'adminkonten@ukri.ac.id'],
            [
                'name' => 'Admin Konten SI UKRI',
                'password' => Hash::make('password'),
            ]
        );
        $adminKonten->assignRole($adminKontenRole);

        $editorBerita = User::firstOrCreate(
            ['email' => 'editorberita@ukri.ac.id'],
            [
                'name' => 'Editor Berita SI UKRI',
                'password' => Hash::make('password'),
            ]
        );
        $editorBerita->assignRole($editorBeritaRole);
    }
}
