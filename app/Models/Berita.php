<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Berita extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'beritas';
    protected $guarded = ['id'];
    protected $appends = ['cover_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
             ->singleFile();
    }

    public function getCoverUrlAttribute(): ?string
    {
        $url = null;
        if ($this->hasMedia('cover')) {
            $url = $this->getFirstMediaUrl('cover');
        } elseif (!empty($this->gambar_cover)) {
            $url = $this->gambar_cover;
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
