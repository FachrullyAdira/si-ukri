<?php

namespace App\Policies;

use App\Models\PesanKontak;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PesanKontakPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function view(User $user, PesanKontak $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function update(User $user, PesanKontak $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function delete(User $user, PesanKontak $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function restore(User $user, PesanKontak $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }

    public function forceDelete(User $user, PesanKontak $model): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin Kemahasiswaan']);
    }
}