<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Products'; 

    // Add these two lines to prevent 500 errors during saving
    public $incrementing = false; 
    protected $keyType = 'string'; 

  protected $fillable = ['id', 'name', 'description', 'price', 'stock_quantity', 'image_url'];
}