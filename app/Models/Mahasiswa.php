<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Mahasiswa extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['user_id', 'nim', 'nama_lengkap', 'angkatan', 'status'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto_mahasiswa')
             ->singleFile();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function krsEnrollments()
    {
        return $this->hasMany(KrsEnrollment::class);
    }
}
