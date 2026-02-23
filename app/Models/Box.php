<?php
// تم التعديل

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    // الحقول المسموح تعبئتها (mass assignment)
    protected $fillable = [
        'name',          // اسم الباقة
        'price',         // السعر
        'description',   // الوصف
        'image_url',     // رابط الصورة
    ];

    // العلاقة مع جدول packages (عنصر واحد يحتوي عدة منتجات)
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
