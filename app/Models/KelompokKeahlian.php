<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KelompokKeahlian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dosenStafs(): HasMany
    {
        return $this->hasMany(DosenStaf::class);
    }

    public function mataKuliahs(): HasMany
    {
        return $this->hasMany(MataKuliah::class);
    }
}
