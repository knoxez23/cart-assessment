<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    public function completeOrder(Request $request)
    {
        $userId = $request->user()->id;
        $cartKey = "cart:{$userId}";

        // Fetch all items in the cart
        $cartItems = Redis::hgetall($cartKey);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('message', 'Your cart is empty.');
        }

        // Get product IDs from the cart
        $productIds = array_keys($cartItems);

        // Fetch product details from the database
        $products = Product::whereIn('id', $productIds)->get();

        // Calculate total price for the order
        $totalPrice = 0;
        foreach ($products as $product) {
            $quantity = $cartItems[$product->id];
            $totalPrice += $product->price * $quantity;
        }

        // Create the order
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'completed',
        ]);

        // Create order items
        foreach ($products as $product) {
            $quantity = $cartItems[$product->id];

            // Create the order items
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        // Clear the cart from Redis
        Redis::del($cartKey);

        // Redirect the user with a success message
        return redirect()->route('cart.index')->with('message', 'Your order has been completed successfully.');
    }

    public function viewOrders()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders', compact('orders'));
    }

public function show($id)
{
    // Retrieve the order by ID, including its associated items.
    $order = Order::with('orderItems')->findOrFail($id);

    return view('details', compact('order'));
}

}
