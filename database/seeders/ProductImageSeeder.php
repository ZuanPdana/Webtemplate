<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::query()
            ->where('status', 'published')
            ->orderBy('id')
            ->get();

        foreach ($products as $index => $product) {
            $imageIndex = $index + 1;
            ProductImage::query()->updateOrCreate(
                [
                    'product_id' => $product->id,
                    'sort_order' => 1,
                ],
                [
                    'image' => "img/product/{$imageIndex}.png",
                    'alt_text' => "{$product->name} image",
                    'is_primary' => true,
                ],
            );
        }
    }
}
