<?php
// تم التعديل

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/webhook',  // استثناء طلبات الـ Webhook من Salla
        'boxes',        // استثناء مسار حفظ الباقات
        'packages',     // استثناء مسار حفظ العناصر
    ];
}
