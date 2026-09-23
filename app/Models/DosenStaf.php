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

    protected $appends = ['foto_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto_profil')
             ->singleFile();
    }

    public function getFotoUrlAttribute(): ?string
    {
        $url = null;
        if ($this->hasMedia('foto_profil')) {
            $url = $this->getFirstMediaUrl('foto_profil');
        } elseif (!empty($this->foto)) {
            $url = $this->foto;
        }

        if (empty($url)) {
            return null;
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        $cleanPath = ltrim($url, '/');
        if (!str_starts_with($cleanPath, 'storage/')) {
            $cleanPath = 'storage/' . $cleanPath;
        }

        return asset($cleanPath);
    }
}
