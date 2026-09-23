<?php

namespace App\Policies;

use App\Models\HimaKegiatan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HimaKegiatanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function view(User $user, HimaKegiatan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function update(User $user, HimaKegiatan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function delete(User $user, HimaKegiatan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function restore(User $user, HimaKegiatan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }

    public function forceDelete(User $user, HimaKegiatan $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan', 'Editor Konten']);
    }
}