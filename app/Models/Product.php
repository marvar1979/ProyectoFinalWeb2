<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Desactiva timestamps para que NO intente usar created_at/updated_at
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
    ];
}
