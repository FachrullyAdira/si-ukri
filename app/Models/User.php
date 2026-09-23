<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        // Super Admin memiliki akses penuh ke seluruh panel sistem
        if ($this->hasRole('Super Admin')) {
            return true;
        }

        // Panel portal publik & login dapat diakses semua pengguna
        if ($panelId === 'portal') {
            return true;
        }

        // Panel Superadmin hanya untuk peran pengelola internal
        if ($panelId === 'admin') {
            return $this->hasRole(['Admin Akademik', 'Admin Kemahasiswaan', 'Editor Konten']);
        }

        // Panel Dosen khusus dosen pengajar
        if ($panelId === 'dosen') {
            return $this->hasRole('Dosen');
        }

        // Panel Mahasiswa khusus mahasiswa aktif
        if ($panelId === 'mahasiswa') {
            return $this->hasRole('Mahasiswa');
        }

        return false;
    }
}
