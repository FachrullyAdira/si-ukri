<?php

namespace App\Policies;

use App\Models\HimaPengurus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HimaPengurusPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function view(User $user, HimaPengurus $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function update(User $user, HimaPengurus $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function delete(User $user, HimaPengurus $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function restore(User $user, HimaPengurus $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function forceDelete(User $user, HimaPengurus $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }
}