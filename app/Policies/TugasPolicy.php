<?php

namespace App\Policies;

use App\Models\Tugas;
use App\Models\User;

class TugasPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function view(User $user, Tugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function update(User $user, Tugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function delete(User $user, Tugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function restore(User $user, Tugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function forceDelete(User $user, Tugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }
}