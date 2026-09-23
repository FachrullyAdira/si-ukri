<?php

namespace App\Policies;

use App\Models\DosenStaf;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DosenStafPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function view(User $user, DosenStaf $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function update(User $user, DosenStaf $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function delete(User $user, DosenStaf $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function restore(User $user, DosenStaf $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }

    public function forceDelete(User $user, DosenStaf $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Akademik', 'Editor Konten']);
    }
}