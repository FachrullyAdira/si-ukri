<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $fillable = ['tugas_id', 'mahasiswa_id', 'file_jawaban_path', 'waktu_pengumpulan', 'nilai', 'catatan_dosen'];

    protected $casts = [
        'waktu_pengumpulan' => 'datetime',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
