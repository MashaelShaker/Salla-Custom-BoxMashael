<?php
// routes/api.php
use App\Http\Controllers\WebhookController; // <--- MUST HAVE THIS
use Illuminate\Support\Facades\Route;
use App\Models\Product; 

Route::post('/webhook', [WebhookController::class, 'handle']);
Route::get('/products', function () {
    return \App\Models\Product::paginate(100); 
}); 
