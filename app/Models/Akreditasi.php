<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Akreditasi extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'akreditasis';
    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('dokumen_pdf')
             ->singleFile();
    }
}
