<?php

namespace App\Policies;

use App\Models\PengaturanSitus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PengaturanSitusPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin']);
    }

    public function view(User $user, PengaturanSitus $model): bool
    {
        return $user->hasAnyRole(['Super Admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin']);
    }

    public function update(User $user, PengaturanSitus $model): bool
    {
        return $user->hasAnyRole(['Super Admin']);
    }

    public function delete(User $user, PengaturanSitus $model): bool
    {
        return $user->hasAnyRole(['Super Admin']);
    }

    public function restore(User $user, PengaturanSitus $model): bool
    {
        return $user->hasAnyRole(['Super Admin']);
    }

    public function forceDelete(User $user, PengaturanSitus $model): bool
    {
        return $user->hasAnyRole(['Super Admin']);
    }
}