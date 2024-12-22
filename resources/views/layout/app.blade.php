<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title', 'Home')</title>
</head>

<body>
    <header>
        <div class="header_logo">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo">
        </div>
        <ul class="nav_links">
            <li>
                <a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="/cart/all" class="{{ request()->is('cart/all') ? 'active' : '' }}">Cart</a>
            </li>
            <li>
                <a href="/orders/all" class="{{ request()->is('orders/all') ? 'active' : '' }}">Orders</a>
            </li>
        </ul>

    </header>
    @if(session('message'))
        <div class="alert alert-success" id="successMessage">
            {{ session('message') }}
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 3000);  // Hide the message after 3 seconds
        </script>
    @endif

    @yield('content')
</body>

</html>
