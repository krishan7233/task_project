<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Cache; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\ProductService;
use App\Models\Order;
class ApiMasters extends Controller
{
    

    protected $categoryService;
    protected $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }



    public function categories_list()
    {
        try {
            $categories = $this->categoryService->getAll();
            return response()->json(['categories' => $categories]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch categories'], 500);
        }
    }

    public function add_categories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $this->categoryService->createCategory($request->all());
            return response()->json(['message' => 'Category created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating category'], 500);
        }
    }

    public function category_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $this->categoryService->update($id, $request->all());
            return response()->json(['message' => 'Category updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating category'], 500);
        }
    }

    public function category_delete($id)
    {

        try {
            $category = Category::findOrFail($id);
            $category->delete();
    
            return response()->json([
                'message' => 'Category deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong.',
                'details' => $e->getMessage()
            ], 500);
        }

    }

    
    
    


    public function userslist()
    {
        try {
            $perPage = request()->input('per_page', 10);

            $users = User::where('usertype', 2)->paginate($perPage);
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch users'], 500);
        }
    }

    // Admin: Delete user
    public function delete_users($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete user'], 500);
        }
    }


    // Update user details
    public function update_users(Request $request,$id)
    {
        try {

            $user = User::find($id); // Assuming the logged-in user is trying to update their details
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404); // Return a 404 if not found
            }

            // $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'mobile' => 'sometimes|digits:10|unique:users,mobile,' . $id,
            ]);

          
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            $user->update($request->all());
    
            return response()->json(['message' => 'User updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update user'], 500);
        }
    }





        public function product_add(Request $request)
    {

        try {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'price' => 'required|numeric',
                'stock_quantity' => 'required|numeric',
                'category' => 'required|array', // Expecting an array of category IDs
                'category.*' => 'exists:categories,id', // Ensure each category is valid
                'images' => 'required|array', // Expecting an array of images
                'images.*' => 'mimes:jpg,jpeg,png,gif|max:2048' // Validate each image
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

          $slug = Str::slug($request->name);
        if (Product::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . uniqid();  // Make slug unique if it already exists
        }

            $request->merge(['slug' => $slug]);

            $this->productService->createProduct($request->all());

            return response()->json(['message' => 'Product created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add product', 'details' => $e->getMessage()], 500);
        }
    }

    public function product_list()
    {
    

        try {
            // Set how many items per page you want
            $perPage = request()->input('per_page', 10); // default 10 if not provided
    
            // Fetch paginated products with relationships
            $products = Cache::remember('products_list', 600, function () {
                return Product::with('categories', 'images')->paginate(10);
            });

            // Return paginated data
            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function product_detail($id)
    {
        try {
            $product = Product::with('categories', 'images')->find($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            return response()->json(['product' => $product]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch product detail'], 500);
        }
    }

    public function product_update(Request $request, $id)
    {
        try {
            
            $product = Product::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'price' => 'required|numeric',
                'stock_quantity' => 'required|numeric',
                'category' => 'required|array',
                'category.*' => 'exists:categories,id',
                'images' => 'nullable|array',
                'images.*' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            $slug = Str::slug($validatedData['name']);
            if (Product::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug .= '-' . uniqid();
            }

            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock_quantity' => $validatedData['stock_quantity'],
                'slug' => $slug,
            ]);

            $product->categories()->sync($validatedData['category']);

            if ($request->has('images')) {
                foreach ($validatedData['images'] as $image) {
                    $path = $image->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product', 'details' => $e->getMessage()], 500);
        }
    }

    public function product_delete($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }


            $product->images->each(function ($image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            });

            $product->categories()->detach();
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete product'], 500);
        }
    }


    public function placeOrder(Request $request)
    {
        try {
            // Retrieve the authenticated user using Sanctum
            $user = auth()->user();

            // Validate the request data
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);

            $productId = $validated['product_id'];
            
            // Find the product
        
            
            $product = Product::find($productId);
           
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found.']);
            }

            // Check if there is enough stock
            if ($product->stock_quantity < 1) {
                return response()->json(['success' => false, 'message' => 'Product out of stock.']);
            }

            // Create unique order number
            $orderNo = 'ORD-' . Str::random(8);

            // Place the order
            $order = Order::create([
                'product_id' => $productId,
                'user_id' => $user->id,
                'orderNo' => $orderNo,
                'total_amount' => $product->price,  // Assuming price is on product
                'status' => 'pending',
            ]);

            // Reduce product stock_quantity by 1
            $product->decrement('stock_quantity');

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order' => $order,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to place order: ' . $e->getMessage()], 500);
        }
    }

     // Order List (For Admin - all orders, for User - only their orders)
     public function orderList()
     {
         try {
            $user = auth()->user();
            $perPage = request()->input('per_page', 10); // default 10 if not provided
    
             // Admin can view all orders
             if ($user->usertype == 1) {
                 $orders = Order::with('product', 'user')->paginate($perPage);
             } else {
                 // User can only view their own orders
                 $orders = Order::with('product', 'user')
                                 ->where('user_id', $user->id)
                                 ->get();
             }
 
             return response()->json(['orders' => $orders]);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Failed to retrieve orders: ' . $e->getMessage()], 500);
         }
     }
 
     // Order Details (For Admin - all orders, for User - only their orders)
     public function orderDetails($id)
     {
         try {
            $user = auth()->user();
             $order = Order::with('product', 'user')->findOrFail($id);
 
             // Admin can view all order details
             if ($user->usertype == 1 || $order->user_id == $user->id) {
                 return response()->json(['order' => $order]);
             } else {
                 return response()->json(['error' => 'Unauthorized'], 403);
             }
         } catch (\Exception $e) {
             return response()->json(['error' => 'Order not found: ' . $e->getMessage()], 404);
         }
     }
 
     // Update Order Status (Only Admin)
     public function updateOrderStatus(Request $request, $id)
     {
         try {
            $user = auth()->user();
 
             // Check if user is admin
             if ($user->usertype !== 1) {
                 return response()->json(['error' => 'Unauthorized'], 403);
             }
 
             // Validate request
             $validated = $request->validate([
                 'status' => 'required|in:pending,completed',
             ]);
 
             $order = Order::findOrFail($id);
             $order->status = $validated['status'];
             $order->save();
 
             return response()->json(['message' => 'Order status updated successfully!', 'order' => $order]);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Failed to update order status: ' . $e->getMessage()], 500);
         }
     }



}
