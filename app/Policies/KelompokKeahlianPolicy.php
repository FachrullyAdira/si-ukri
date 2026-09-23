<?php

namespace App\Policies;

use App\Models\KelompokKeahlian;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KelompokKeahlianPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function view(User $user, KelompokKeahlian $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function update(User $user, KelompokKeahlian $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function delete(User $user, KelompokKeahlian $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function restore(User $user, KelompokKeahlian $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function forceDelete(User $user, KelompokKeahlian $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }
}