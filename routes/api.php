<?php
// routes/api.php
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\Api\ProductController;
use App\Models\Box;

Route::post('/webhook', [WebhookController::class, 'handle']);

Route::get('/products', [ProductController::class, 'index']);


Route::get('/boxes/{id}/packages', function ($id) {
    $box = \App\Models\Box::with('packages')->find($id);
    
    if (!$box) {
        return response()->json([
            'success' => false,
            'message' => 'Box not found'
        ], 404);
    }
    
    return response()->json($box->packages);
}); 
