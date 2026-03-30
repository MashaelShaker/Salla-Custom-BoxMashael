<?php
// تم التعديل

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Package;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function store(Request $request)
    {
        try {
            // إذا جاءت العناصر كـ JSON string، حولها لمصفوفة
            if (is_string($request->input('elements'))) {
                $elements = json_decode($request->input('elements'), true);
                $request->merge(['elements' => $elements]);
            }

            // التحقق من البيانات
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0.01',
                'description' => 'required|string',
                'image' => 'nullable|image|max:2048',
                'elements' => 'required|array|min:1',
                'elements.*.name' => 'required|string|max:255',
                'elements.*.products' => 'required|array|min:1',
                'elements.*.products.*.name' => 'required|string|max:255',
                'elements.*.products.*.price' => 'required|numeric|min:0.01',
                'elements.*.products.*.image' => 'nullable|string',
            ]);

            // حفظ الصورة إن وجدت
            $imagePath = '';
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('boxes', 'public');
            }

            // إنشاء الباقة
            $box = Box::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'image_url' => $imagePath,
            ]);

            // إنشاء المنتجات
            foreach ($validated['elements'] as $element) {
                foreach ($element['products'] as $product) {
                    Package::create([
                        'box_id' => $box->id,
                        'product_id' => $element['product_id'] ?? null,
                     
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'تم الحفظ بنجاح!',
                'box_id' => $box->id,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ: ' . $e->getMessage(),
            ], 500);
        }
    }
}
