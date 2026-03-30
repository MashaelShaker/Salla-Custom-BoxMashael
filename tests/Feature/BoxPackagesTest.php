<?php

namespace Tests\Feature;

use App\Models\Box;
use App\Models\Package;
use Tests\TestCase;

class BoxPackagesTest extends TestCase
{
    /**
     * اختبار جلب الـ packages المرتبطة بـ Box
     */
    public function test_get_box_packages()
    {
        // إنشاء Box للاختبار
        $box = Box::factory()->create();
        
        // إنشاء عدة packages مرتبطة بـ Box
        Package::factory(3)->create([
            'box_id' => $box->id
        ]);
        
        // عمل request للـ API
        $response = $this->getJson("/api/boxes/{$box->id}/packages");
        
        // التحقق من الكود
        $response->assertStatus(200);
        
        // التحقق من البيانات
        $response->assertJson([
            'success' => true,
            'box' => [
                'id' => $box->id,
                'name' => $box->name,
            ],
            'packages_count' => 3,
        ]);
    }
    
    /**
     * اختبار عدم وجود Box
     */
    public function test_box_not_found()
    {
        $response = $this->getJson('/api/boxes/999/packages');
        
        $response->assertStatus(404);
        $response->assertJson([
            'success' => false,
            'message' => 'Box not found'
        ]);
    }
}
