<?php

namespace App\Policies;

use App\Models\PengumpulanTugas;
use App\Models\User;

class PengumpulanTugasPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function view(User $user, PengumpulanTugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Dosen', 'Mahasiswa']);
    }

    public function update(User $user, PengumpulanTugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Dosen', 'Mahasiswa']);
    }

    public function delete(User $user, PengumpulanTugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Dosen']);
    }

    public function restore(User $user, PengumpulanTugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Dosen']);
    }

    public function forceDelete(User $user, PengumpulanTugas $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Dosen']);
    }
}