<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class KelompokKeahlian extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];
    protected $appends = ['ikon_url'];

    public function dosenStafs(): HasMany
    {
        return $this->hasMany(DosenStaf::class);
    }

    public function mataKuliahs(): HasMany
    {
        return $this->hasMany(MataKuliah::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('ikon')
             ->singleFile();
    }

    public function getIkonUrlAttribute(): ?string
    {
        $url = null;
        if ($this->hasMedia('ikon')) {
            $url = $this->getFirstMediaUrl('ikon');
        } elseif (!empty($this->ikon)) {
            if (preg_match('/\.(png|jpe?g|svg|webp|gif)$/i', $this->ikon) || str_starts_with($this->ikon, 'http') || str_starts_with($this->ikon, '/')) {
                $url = $this->ikon;
            }
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
