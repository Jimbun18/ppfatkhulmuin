<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    // Tambahkan ini agar kolom images otomatis jadi Array
    protected $casts = [
        'images' => 'array',
    ];
}