<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    // Add an item to the cart
    public function addToCart(Request $request)
    {
        $userId = $request->user()->id;
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        $cartKey = "cart:{$userId}";

        // Increment the product quantity if it already exists
        Redis::hincrby($cartKey, $productId, $quantity);

        // Redirect back to the cart page with a success message
        return redirect()->route('cart.index')->with('message', 'Item added to cart successfully.');
    }


    public function removeFromCart(Request $request)
    {
        $userId = $request->user()->id;
        $productId = $request->input('product_id');

        $cartKey = "cart:{$userId}";

        // Remove the product from the cart
        Redis::hdel($cartKey, $productId);

        // Redirect back to the cart page with a success message
        return redirect()->route('cart.index')->with('message', 'Item removed from cart successfully.');
    }



    public function displayCart(Request $request)
    {
        $userId = $request->user()->id;
        $cartKey = "cart:{$userId}";

        // Fetch all items in the cart
        $cartItems = Redis::hgetall($cartKey);

        if (empty($cartItems)) {
            return view('cart', ['cart' => [], 'message' => 'Your cart is empty.']);
        }

        // Get product IDs from the cart
        $productIds = array_keys($cartItems);

        // Fetch product details from the database
        $products = Product::whereIn('id', $productIds)->get();

        // Map product details to cart items
        $detailedCart = $products->map(function ($product) use ($cartItems) {
            $quantity = $cartItems[$product->id] ?? 0;

            return [
                'product_id' => $product->id,
                'name' => $product->car_name,
                'image' => $product->image,
                'description' => $product->description,
                'price' => $product->price,
                'quantity' => $quantity,
                'total' => $product->price * $quantity,
            ];
        });

        return view('cart', ['cart' => $detailedCart]);
    }
}
