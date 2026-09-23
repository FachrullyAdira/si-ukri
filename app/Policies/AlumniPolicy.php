<?php

namespace App\Policies;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlumniPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function view(User $user, Alumni $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function update(User $user, Alumni $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function delete(User $user, Alumni $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function restore(User $user, Alumni $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function forceDelete(User $user, Alumni $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }
}