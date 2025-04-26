<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
class HomeController extends Controller
{
    //

    public function index(){
        $products = Product::with(['categories', 'images'])->where('status', 1)->get();

        return view('home', compact('products'));
      
    }


    public function placeOrder($productId, Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please log in to place an order.']);
        }

        // Find the product
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        // Check if there is enough stock
        if ($product->stock_quantity < 1) {
            return response()->json(['success' => false, 'message' => 'Product out of stock.']);
        }

        // Place the order
        $order = Order::create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'orderNo' => 'ORD-' . Str::random(8),
            'total_amount' => $product->price,  // Assuming price is on product
            'status' => 'pending'
        ]);

        // Reduce product stock_quantity by 1
        $product->decrement('stock_quantity');

        // Respond with success message
        return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    }

    public function users_order(){
        $user = Auth::user();
        $orders = Order::with(['product.categories'])->where('user_id', $user->id)->get();
        return view('user_orders', compact('orders'));
    }

}
