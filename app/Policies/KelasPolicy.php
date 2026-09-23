<?php

namespace App\Policies;

use App\Models\Kelas;
use App\Models\User;

class KelasPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function view(User $user, Kelas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function update(User $user, Kelas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function delete(User $user, Kelas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function restore(User $user, Kelas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function forceDelete(User $user, Kelas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }
}