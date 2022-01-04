<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kewajiban()
    {
        return $this->hasMany(Kewajiban::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'tahun_ajaran_id');
    }
}
