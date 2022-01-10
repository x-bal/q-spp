<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function kewajiban()
    {
        return $this->belongsToMany(Kewajiban::class)->withPivot('tgl_bayar', 'status', 'nominal')->orderByPivot('kewajiban_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spp()
    {
        return $this->belongsToMany(Spp::class)->withPivot('tanggal_bayar', 'status', 'nominal')->orderByPivot('spp_id');
    }
}
