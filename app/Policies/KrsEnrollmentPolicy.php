<?php

namespace App\Policies;

use App\Models\KrsEnrollment;
use App\Models\User;

class KrsEnrollmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function view(User $user, KrsEnrollment $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Dosen', 'Mahasiswa']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Mahasiswa']);
    }

    public function update(User $user, KrsEnrollment $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function delete(User $user, KrsEnrollment $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function restore(User $user, KrsEnrollment $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function forceDelete(User $user, KrsEnrollment $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }
}