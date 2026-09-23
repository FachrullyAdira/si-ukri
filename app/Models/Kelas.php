<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['mata_kuliah_id', 'dosen_staf_id', 'kode_kelas', 'tahun_akademik', 'hari', 'jam_mulai', 'jam_selesai'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dosenStaf()
    {
        return $this->belongsTo(DosenStaf::class);
    }

    public function materiPertemuans()
    {
        return $this->hasMany(MateriPertemuan::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function enrollments()
    {
        return $this->hasMany(KrsEnrollment::class);
    }
}
