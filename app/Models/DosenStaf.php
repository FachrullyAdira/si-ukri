<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DosenStaf extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'dosen_stafs';
    protected $guarded = ['id'];

    public function kelompokKeahlian(): BelongsTo
    {
        return $this->belongsTo(KelompokKeahlian::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto_profil')
             ->singleFile();
    }
}
