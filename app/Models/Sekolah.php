<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function yayasan()
    {
        return $this->belongsTo(Yayasan::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
