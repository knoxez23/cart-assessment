@extends('layout.app')
<title>Cart</title>

@section('content')
    <div class="container">
        <h1>Your Shopping Cart</h1>

        @if (count($cart) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"></td>
                            <td>{{ $item['description'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['total'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                <span>Total:</span>
                <span>${{ number_format($cart->sum('total'), 2) }}</span>
            </div>

            <div class="cart-actions">
                <form action="{{ route('cart.completeOrder') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Complete Order</button>
                </form>
            </div>
        @else
            <div class="empty-cart">
                <p>Your cart is empty.</p>
            </div>
        @endif
    </div>

@endsection
