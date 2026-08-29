<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';
    protected $guarded = ['id'];

    public function kelompokKeahlian(): BelongsTo
    {
        return $this->belongsTo(KelompokKeahlian::class);
    }
}
