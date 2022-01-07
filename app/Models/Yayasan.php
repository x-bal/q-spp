<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yayasan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }
}
