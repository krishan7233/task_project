<?php


namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        // Get all category IDs
        $categories = Category::pluck('id')->toArray();

        // Generate a unique slug
        $slug = $this->generateUniqueSlug($this->faker->unique()->word());

        return [
            'name' => $this->faker->word(),
            'slug' => $slug,
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock_quantity' => $this->faker->randomDigitNotNull(),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }

    // Method to generate unique slug
    private function generateUniqueSlug($slug)
    {
        $slug = Str::slug($slug);
        $originalSlug = $slug;
        $count = 1;
        
        // Check if the slug already exists in the database and ensure uniqueness
        while (Product::where('slug', $slug)->exists()) {
            // Append a random string or counter to the slug to make it unique
            $slug = $originalSlug . '-' . uniqid();
        }
        
        return $slug;
    }

    // Optionally, you can create a factory method for relationships like categories
    public function withCategories($count = 2)
    {
        return $this->afterCreating(function (Product $product) use ($count) {
            // Assign random categories to the product
            $categories = Category::pluck('id')->random($count)->toArray();
            $product->categories()->sync($categories);
        });
    }




    // public function withImages()
    // {
    //     return $this->afterCreating(function (Product $product) {
    //         // Generate a fake image and store it locally
    //         $faker = \Faker\Factory::create();

    //         foreach (range(1, 3) as $index) {
    //             $imagePath = 'product_images/' . Str::random(10) . '.jpg';
                
    //             // Use Faker's image generator to create a local image
    //             $imageFile = $faker->image(public_path('storage/product_images'), 640, 480, null, false);

    //             if ($imageFile) {
    //                 // Move the generated image to the correct directory
    //                 $imagePath = 'product_images/' . Str::random(10) . '.jpg';
    //                 Storage::disk('public')->put($imagePath, file_get_contents($imageFile));

    //                 // Store image in ProductImage table
    //                 ProductImage::create([
    //                     'product_id' => $product->id,
    //                     'image_path' => $imagePath,
    //                 ]);
    //             }
    //         }
    //     });
    // }


//     public function withImages()
// {
//     return $this->afterCreating(function (Product $product) {
//         // Generate a fake image and store it locally
//         $faker = \Faker\Factory::create();

//         foreach (range(1, 3) as $index) {
//             $imagePath = 'product_images/' . Str::random(10) . '.jpg';
            
//             // Use Faker's image generator to create a local image
//             $imageFile = $faker->image(public_path('storage/product_images'), 640, 480, null, false);

//             // Check if the image was generated
//             if ($imageFile) {
//                 $newImagePath = 'product_images/' . Str::random(10) . '.jpg';
                
//                 // Check if image exists and move it to the correct directory
//                 if (file_exists($imageFile)) {
//                     // Store the image in the public disk (storage/app/public)
//                     Storage::disk('public')->put($newImagePath, file_get_contents($imageFile));

//                     $image = $request->file('image');
//                     $imagePath = $image->store('product_images', 'public'); 
//                     // Debug: Check if the image is stored
//                     \Log::info("Image stored at: " . $newImagePath);

//                     // Store image in ProductImage table
//                     ProductImage::create([
//                         'product_id' => $product->id,
//                         'image_path' => $newImagePath,
//                     ]);
//                 } else {
//                     \Log::warning("Image file not found at: " . $imageFile);
//                 }
//             } else {
//                 \Log::warning("Image generation failed for product ID: " . $product->id);
//             }
//         }
//     });
// }


public function withImages()
{
    return $this->afterCreating(function (Product $product) {
        // Initialize Faker for image generation
        $faker = \Faker\Factory::create();

        // Ensure the product_images directory exists and is writable
        $storagePath = public_path('storage/product_images');
        if (!is_dir($storagePath)) {
            \Log::error("Directory does not exist: " . $storagePath);
            mkdir($storagePath, 0775, true);
        }
        
        // Log if directory is writable
        if (is_writable($storagePath)) {
            \Log::info("Directory is writable: " . $storagePath);
        } else {
            \Log::error("Directory is not writable: " . $storagePath);
        }

        // Loop through to generate and store images
        foreach (range(1, 3) as $index) {
            $imageFile = $faker->image($storagePath, 640, 480, null, false);

            // Check if the image was successfully generated
            if ($imageFile) {
                \Log::info("Image generated: " . $imageFile);

                // Define new image path
                $newImagePath = 'product_images/' . Str::random(10) . '.jpg';
                
                // Check if the image exists and move it to the correct directory
                if (file_exists($imageFile)) {
                    // Store the image in the public disk (storage/app/public)
                    Storage::disk('public')->put($newImagePath, file_get_contents($imageFile));

                    // Log the stored image path
                    \Log::info("Image stored at: " . $newImagePath);

                    // Store image in ProductImage table
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $newImagePath,
                    ]);
                } else {
                    \Log::warning("Image file not found at: " . $imageFile);
                }
            } else {
                \Log::warning("Image generation failed for product ID: " . $product->id);
            }
        }
    });
}



}