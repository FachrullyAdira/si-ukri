<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sejarah extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'sejarahs';
    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')
             ->singleFile();
    }
}
