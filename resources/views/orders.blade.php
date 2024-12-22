@extends('layout.app')
    <title>Orders</title>
@section('content')
    <div class="container">
        <h1>Your Orders</h1>

        @if(count($orders) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    {{-- <th>Details</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        {{-- <td>
                            <a href="{{ route('orders.details', $order->id) }}" class="btn btn-info">View Details</a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        @else
            <div class="empty-orders">
                <p>You have no orders yet.</p>
            </div>
        @endif
    </div>
@endsection
