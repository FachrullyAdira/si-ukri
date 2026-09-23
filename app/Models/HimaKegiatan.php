<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HimaKegiatan extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'hima_kegiatans';
    protected $guarded = ['id'];
    protected $appends = ['foto_url', 'tanggal_rentang'];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')
             ->singleFile();
    }

    public function getTanggalRentangAttribute(): string
    {
        if (!$this->tanggal) {
            return '-';
        }

        $mulai = \Carbon\Carbon::parse($this->tanggal)->locale('id');

        if (!$this->tanggal_selesai || $mulai->isSameDay($this->tanggal_selesai)) {
            return $mulai->translatedFormat('d F Y');
        }

        $selesai = \Carbon\Carbon::parse($this->tanggal_selesai)->locale('id');

        // Same month and year: "20 - 22 Juli 2026"
        if ($mulai->format('Y-m') === $selesai->format('Y-m')) {
            return $mulai->translatedFormat('d') . ' - ' . $selesai->translatedFormat('d F Y');
        }

        // Same year, different months: "28 Juli - 02 Agustus 2026"
        if ($mulai->format('Y') === $selesai->format('Y')) {
            return $mulai->translatedFormat('d F') . ' - ' . $selesai->translatedFormat('d F Y');
        }

        // Different years: "28 Desember 2026 - 02 Januari 2027"
        return $mulai->translatedFormat('d F Y') . ' - ' . $selesai->translatedFormat('d F Y');
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
