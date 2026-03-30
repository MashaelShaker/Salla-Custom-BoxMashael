<?php
// تم التعديل

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // الحقول المسموح تعبئتها (mass assignment)
    protected $fillable = [
        'box_id',           // معرّف الباقة الأب
        'package_name',     // اسم العنصر
        'product_name',     // اسم المنتج
        'product_price',    // سعر المنتج
        'product_image',    // صورة المنتج
    ];

    // العلاقة مع جدول boxes (كل عنصر يتبع باقة واحدة)
    public function box()
    {
        return $this->belongsTo(Box::class);
    }

       public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
