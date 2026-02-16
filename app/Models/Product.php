<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // 1. Specify the table name
    protected $table = 'Products';

    // Add these two lines to prevent 500 errors during saving
    public $incrementing = false;
    protected $keyType = 'string';
    // 2. Allow these fields to be filled by your Sync command
    protected $fillable = [
        'salla_product_id',
        'external_id',
        'name',
        'description',
        'price',
        'stock_quantity',
        'image_url'
    ];
}
