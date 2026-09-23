<?php

namespace App\Policies;

use App\Models\MateriPertemuan;
use App\Models\User;

class MateriPertemuanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function view(User $user, MateriPertemuan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function update(User $user, MateriPertemuan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function delete(User $user, MateriPertemuan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function restore(User $user, MateriPertemuan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }

    public function forceDelete(User $user, MateriPertemuan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen']);
    }
}