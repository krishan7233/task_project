<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use App\Services\ProductService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    
    protected $categoryService;
    protected $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }


    public function store_category(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->categoryService->createCategory($validated);

        return redirect()->route('category-list')->with('success', 'Category added successfully!');
    }


    public function dashboard(){
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalOrders = 10;
    
        // Pass the counts to the view
        return view('dashbord', compact('totalCategories', 'totalProducts', 'totalUsers', 'totalOrders'));
    
    }

    public function category_list(){
        return view('category_list');
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select(['id', 'name', 'description', 'status', 'created_at']);
            return DataTables::of($data)
                ->editColumn('status', function ($row) {
                    return $row->status ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="'.route('edit-category', $row->id).'" class="btn btn-sm btn-primary">Edit</a>';
                    $deleteBtn = '<button data-id="'.$row->id.'" class="btn btn-sm btn-danger delete-category">Delete</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action']) // allow HTML rendering
                ->make(true);
        }
    }
    

    public function delete_category($id)
    {
        $category = Category::findOrFail($id);
        $category->delete(); // now this is soft delete

        return response()->json(['message' => 'Category soft-deleted successfully']);
    }

    public function edit_category($id)
{
    $category = Category::findOrFail($id);
    return view('category_edit', compact('category'));
}

public function update_category(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'status' => 'required|boolean',
    ]);

    app(CategoryService::class)->update($id, $request->all());

    return redirect()->route('category-list')->with('success', 'Category updated successfully.');
}



    public function add_category(){
        return view('add_category');
    }


    public function product_list(){
        return view('product_list');
    }


    public function add_product()
    {
        $categories = Category::all(); // Retrieve all categories for the dropdown
        return view('add_product', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|numeric',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Generate the slug based on the product name
        $slug = Str::slug($request->name);
    
        // Ensure the slug is unique in the database
        if (Product::where('slug', $slug)->exists()) {
            // If the slug already exists, append a unique identifier
            $slug = $slug . '-' . uniqid();
        }
    
        // Add the generated slug to the request data
        $request->merge(['slug' => $slug]);
    
        // Call the service to store the product
        $this->productService->createProduct($request->all());

        

        // Redirect with a success message
        return redirect()->route('product-list')->with('success', 'Product created successfully!');
    }

    public function fetch_products()
    {
        $products = Product::with('categories', 'images')->get();  // Eager load categories and images
        return DataTables::of($products)
        ->addColumn('categories', function ($product) {
            return $product->categories->pluck('name')->join(', ');
        })
        ->addColumn('images', function ($product) {
            // Create an array of image URLs with small size
            $imagePaths = $product->images->pluck('image_path')->toArray();
            $imageUrls = array_map(function ($path) {
                return asset('storage/' . $path);
            }, $imagePaths);

            // Generate image HTML tags with small size (set width, height, or apply a CSS class for smaller size)
            $imagesHtml = '';
            foreach ($imageUrls as $url) {
                $imagesHtml .= '<img src="' . $url . '" width="100" height="100" style="margin-right: 5px;" />';  // Small size (100x100)
            }

            return $imagesHtml;
        })
        ->addColumn('action', function ($product) {
            return '
                <a href="' . route('edit-product', $product->id) . '" class="btn btn-warning btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm delete-product" data-id="' . $product->id . '">Delete</button>
            ';
        })
        ->rawColumns(['action', 'images'])  // Mark images and action columns as raw to allow HTML rendering
        ->make(true);
    }


    public function edit_product($id)
    {
        // Get product data for editing
        $product = Product::with('categories', 'images')->find($id);
        $categories = Category::all();

        return view('edit_product', compact('product', 'categories'));
    }

    public function deleteImage($imageId)
{
    // Find the image by ID
    $image = ProductImage::findOrFail($imageId);

    // Delete the image file from the storage
    Storage::delete('public/' . $image->image_path);

    // Delete the image record from the database
    $image->delete();

    // Return a response indicating success
    return response()->json(['success' => true]);
}


    public function update_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate and update product
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
        $existingSlugCount = \App\Models\Product::where('slug', $slug)->where('id', '!=', $product->id)->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }


        $product = Product::find($id);
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->stock_quantity = $validatedData['stock_quantity'];
        $product->slug =$slug;

        $product->save();

        // Sync categories
        $product->categories()->sync($validatedData['category']);

        // Handle image updates (if any)
        if ($request->has('images')) {
            foreach ($validatedData['images'] as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('product-list')->with('success', 'Product updated successfully!');
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        
        // Delete associated images
        $product->images->each(function ($image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete();
        });

        // Delete product categories association
        $product->categories()->detach();

        // Delete product record
        $product->delete();

        return response()->json(['success' => 'Product deleted successfully']);
    }

    public function users_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('usertype', 2)->select(['id', 'name', 'email','mobile', 'status', 'created_at']);
            return DataTables::of($data)
                ->editColumn('status', function ($row) {
                    return $row->status ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($row) {
                    $deleteBtn = '<button data-id="'.$row->id.'" class="btn btn-sm btn-danger delete-users">Delete</button>';
                    return $deleteBtn;
                })
                ->rawColumns(['action']) // allow HTML rendering
                ->make(true);
        }
    }

    public function userslist(){
        return view('users_list');
    }
    
    public function delete_users($id){
        
        $user = User::findOrFail($id);
        $user->delete(); // now this is soft delete

        return response()->json(['message' => 'User soft-deleted successfully']);

    }

    public function orderslist(){
        return view('orders_list');
    }


    public function getOrdersData(Request $request)
    {
        if ($request->ajax()) {
            // Eager load the necessary relationships (product and user)
            $orders = Order::with(['product', 'product.categories', 'user'])->get();
    
            return DataTables::of($orders)
                ->addColumn('product_name', function ($order) {
                    return $order->product ? $order->product->name : 'N/A'; // Product Name
                })
                ->addColumn('category_name', function ($order) {
                    if ($order->product && $order->product->categories->isNotEmpty()) {
                        return $order->product->categories->pluck('name')->implode(', ');
                    }
                    return 'N/A';
                })
                ->addColumn('username', function ($order) {
                    return $order->user ? $order->user->name : 'N/A'; // Username
                })
                ->addColumn('status', function ($order) {
                    return $order->status; // Order Status
                })
                ->addColumn('action', function ($order) {
                    return view('action', compact('order'))->render(); // Render action buttons
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function updateStatus($orderId, Request $request)
    {
        $order = Order::findOrFail($orderId);
        $order->status = 'completed'; // Update status to completed
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated to completed.']);
    }


}
