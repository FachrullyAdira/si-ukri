<?php

namespace App\Policies;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrestasiPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten', 'Admin Kemahasiswaan', 'Admin Akademik']);
    }

    public function view(User $user, Prestasi $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten', 'Admin Kemahasiswaan', 'Admin Akademik']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten', 'Admin Kemahasiswaan']);
    }

    public function update(User $user, Prestasi $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten', 'Admin Kemahasiswaan']);
    }

    public function delete(User $user, Prestasi $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten', 'Admin Kemahasiswaan']);
    }

    public function restore(User $user, Prestasi $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten', 'Admin Kemahasiswaan']);
    }

    public function forceDelete(User $user, Prestasi $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten', 'Admin Kemahasiswaan']);
    }
}