@extends('layout.app')
@yield('title')
@section('content')
    <section class="products_container">
        <h2 class="products_heading">All Products</h2>
        <div class="products_grid">
            @foreach ($products as $product)
                <div class="product_card">
                    <div class="product_image">
                        <img src="{{ asset($product->image) }}" alt="Car Image">
                    </div>
                    <div class="product_details">
                        <h3 class="product_name">{{ $product->car_name }}</h3>
                        <p class="product_description">{{ $product->description }}</p>
                        <span>{{ $product->price }}</span>
                    </div>
                    <form action="cart/add" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add_to_cart_btn">Add to Cart</a>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
