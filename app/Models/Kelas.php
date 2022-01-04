<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function kewajiban()
    {
        return $this->belongsToMany(Kewajiban::class);
    }
}
