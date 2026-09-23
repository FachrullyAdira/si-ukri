<?php

namespace App\Policies;

use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MataKuliahPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function view(User $user, MataKuliah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function update(User $user, MataKuliah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function delete(User $user, MataKuliah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function restore(User $user, MataKuliah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function forceDelete(User $user, MataKuliah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }
}