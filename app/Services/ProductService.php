<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function createProduct($data)
    {
        // Create a new product instance
        $product = new Product();
        $product->name = $data['name'];
        $product->slug = $data['slug'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->stock_quantity = $data['stock_quantity'];
        $product->status = 1; // Default to active if not set
        $product->save();

        // Associate categories with the product
        $product->categories()->sync($data['category']);

        // Handle image uploads if provided
       
          // Handle image uploads if provided
          if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                // Store the image in the public 'product_images' folder
                $path = $image->store('product_images', 'public');
                
                // Create a new record in the ProductImage table with the image path
                ProductImage::create([
                    'product_id' => $product->id,  // Link to the created product
                    'image_path' => $path,          // Path to the uploaded image
                ]);
            }
        }


    }
}
