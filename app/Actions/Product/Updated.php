<?php
namespace App\Actions\Product;

use App\Actions\BaseAction;
use App\Models\Product;

class Updated extends BaseAction
{
    protected $data;

    // 1. Add this constructor to catch the data from the Controller
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        // 2. Use $this->data to save the product
        return Product::updateOrCreate(
            ['id' => $this->data['id']],
            [
                'name'           => $this->data['name'] ?? '',
                'description'    => $this->data['description'] ?? '',
                'price'          => $this->data['price']['amount'] ?? 0,
                'stock_quantity' => $this->data['quantity'] ?? 0,
                'image_url'      => $this->data['main_image'] ?? null,
                'salla_product_id' => $this->data['id'],
            ]
        );
    }
}