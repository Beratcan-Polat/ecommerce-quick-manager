<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const CATEGORIES = [
        'Elektronik',
        'Giyim',
        'Ev & Yaşam',
        'Spor',
        'Kitap',
        'Oyuncak',
    ];
    
    protected $fillable = [
        'name',
        'sku',
        'category',
        'price',
        'stock',
    ];
}
