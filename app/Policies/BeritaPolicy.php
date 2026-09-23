<?php

namespace App\Policies;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BeritaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten']);
    }

    public function view(User $user, Berita $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten']);
    }

    public function update(User $user, Berita $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten']);
    }

    public function delete(User $user, Berita $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten']);
    }

    public function restore(User $user, Berita $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten']);
    }

    public function forceDelete(User $user, Berita $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Editor Konten']);
    }
}