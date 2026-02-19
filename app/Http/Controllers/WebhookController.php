<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Product\Updated; 

class WebhookController extends Controller
{
   public function handle(Request $request)
{
    $event = $request->input('event');
    $data  = $request->input('data');

    if ($event === 'product.updated') {
        (new \App\Actions\Product\Updated($data))->handle();
    }

    if ($event === 'product.created') {
        (new \App\Actions\Product\Updated($data))->handle();
    }

    return response()->json(['success' => true]);
}
}