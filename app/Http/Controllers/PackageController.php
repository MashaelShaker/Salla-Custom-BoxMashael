<?php
// تم التعديل

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * حفظ عنصر واحد (Package) مع منتجاته وربطه بباقة موجودة
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المستقبلة
        $validated = $request->validate([
            'box_id' => ['required', 'integer', 'exists:boxes,id'],         // معرف الباقة (يجب أن تكون موجودة)
            'package_name' => ['required', 'string', 'max:255'],             // اسم العنصر
            'products' => ['required', 'array', 'min:1'],                    // قائمة المنتجات (مصفوفة)
            'products.*.name' => ['required', 'string', 'max:255'],          // اسم المنتج
            'products.*.price' => ['required', 'numeric', 'min:0.01'],       // سعر المنتج
            'products.*.image' => ['nullable', 'string'],                    // رابط صورة المنتج
        ]);

        // حفظ كل منتج من المنتجات كسجل منفصل في جدول packages
        foreach ($validated['products'] as $product) {
            Package::create([
                'box_id' => $validated['box_id'],                // ربط المنتج بالباقة
                'package_name' => $validated['package_name'],    // اسم العنصر
                'product_name' => $product['name'],              // اسم المنتج
                'product_price' => $product['price'],            // سعر المنتج
                'product_image' => $product['image'] ?? '',      // رابط الصورة أو قيمة فارغة
            ]);
        }

        // إرجاع استجابة نجاح
        return response()->json([
            'success' => true,
            'message' => 'تم حفظ العنصر والمنتجات بنجاح!',
        ], 201);
    }
}
