<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HimaPengurus extends Model
{
    use HasFactory;

    protected $table = 'hima_pengurus';
    protected $guarded = ['id'];
}
