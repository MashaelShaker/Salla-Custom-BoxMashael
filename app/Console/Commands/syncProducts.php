<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class syncProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch products from Salla API';

    /**
     * Execute the console command.
     */
 public function handle()
{
    $this->info("Starting sync...");
    $totalSynced = 0;
    $token = 'ory_at_L6NFfT4SrIphxiPi5kxLYRfJ89zEAL9Y-_k7Wcg4mTo.xWYp0AtNWRKTu373Q6L59OKNL4DaVbuhgIhamxROZ4g';

    // We will check the first 5 pages (100 products per page = 500 products)
    for ($page = 1; $page <= 5; $page++) {
        $this->comment("Fetching page $page...");
        
        $response = Http::withToken($token)
            ->get("https://api.salla.dev/admin/v2/products", [
                'per_page' => 100,
                'page' => $page
            ]);

        if ($response->successful()) {
            $data = $response->json()['data'];

            // If the page is empty, we've reached the end of your store
            if (empty($data)) {
                break; 
            }

            foreach ($data as $item) {
                \App\Models\Product::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'name'           => $item['name'],
                        'description'    => $item['description'] ?? '',
                        'price'          => $item['price']['amount'] ?? 0,
                        'stock_quantity' => $item['quantity'] ?? 0,
                        'image_url'      => $item['main_image'] ?? '',
                    ]
                );
                $totalSynced++;
            }
        } else {
            $this->error("Failed to fetch page $page");
            break;
        }
    }

    $this->info("Success! Finished syncing $totalSynced products.");
}

}