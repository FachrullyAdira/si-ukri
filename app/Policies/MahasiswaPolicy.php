<?php

namespace App\Policies;

use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Admin Kemahasiswaan', 'Dosen', 'Mahasiswa']);
    }

    public function view(User $user, Mahasiswa $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Admin Kemahasiswaan', 'Dosen', 'Mahasiswa']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function update(User $user, Mahasiswa $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function delete(User $user, Mahasiswa $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function restore(User $user, Mahasiswa $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function forceDelete(User $user, Mahasiswa $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }
}