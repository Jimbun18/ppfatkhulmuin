<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    
    // Izinkan semua kolom diisi (biar cepat)
    protected $guarded = ['id']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}