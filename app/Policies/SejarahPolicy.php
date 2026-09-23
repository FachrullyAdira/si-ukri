<?php

namespace App\Policies;

use App\Models\Sejarah;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SejarahPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function view(User $user, Sejarah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function update(User $user, Sejarah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function delete(User $user, Sejarah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function restore(User $user, Sejarah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }

    public function forceDelete(User $user, Sejarah $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik']);
    }
}