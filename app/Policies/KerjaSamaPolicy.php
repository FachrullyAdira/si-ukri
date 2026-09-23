<?php

namespace App\Policies;

use App\Models\KerjaSama;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KerjaSamaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function view(User $user, KerjaSama $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function update(User $user, KerjaSama $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function delete(User $user, KerjaSama $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function restore(User $user, KerjaSama $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function forceDelete(User $user, KerjaSama $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }
}