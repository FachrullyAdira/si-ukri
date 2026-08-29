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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')
             ->singleFile();
    }
}
