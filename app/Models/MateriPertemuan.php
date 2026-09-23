<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriPertemuan extends Model
{
    use HasFactory;

    protected $fillable = ['kelas_id', 'pertemuan_ke', 'judul_materi', 'deskripsi', 'file_path'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
