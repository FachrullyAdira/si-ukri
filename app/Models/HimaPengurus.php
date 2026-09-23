<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HimaPengurus extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'hima_pengurus';
    protected $guarded = ['id'];
    protected $appends = ['foto_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')
             ->singleFile();
    }

    public function getFotoUrlAttribute(): ?string
    {
        $url = null;
        if ($this->hasMedia('foto')) {
            $url = $this->getFirstMediaUrl('foto');
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
