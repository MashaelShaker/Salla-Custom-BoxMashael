<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 1. Specify the table name (matching what you used in your migration)
    protected $table = 'Products'; 

    // 2. Allow these fields to be filled by your Sync command
    protected $fillable = [ 
        'id',           // This was the cause of your last error!
        'name', 
        'description', 
        'price', 
        'stock_quantity', 
        'image_url' 
    ];
}