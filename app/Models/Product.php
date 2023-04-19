<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ="products";

    protected $casts = [
        'images' => 'array', // Will convarted to (Array)
    ];
}
