@extends('layouts.main')

@section('container')

<h1>Checkout</h1>

<div class="row">
    <div class="col-md-6">
        <br>
        <h2>User Details</h2>
        @auth
        <br>
            <p>Name: {{ Auth::user()->name }}</p>
            <p>Email Id: {{ Auth::user()->email }}</p>
            <p>Phone: {{ Auth::user()->phonenum }}</p>
            <p>Address: {{ Auth::user()->address }}</p>
        @endauth
        <br>
        <h2>Order Information</h2>
        <br>
        <p>Order ID: #{{$orderID}}</p>
        <p>Payment Mode: Cash On Delivery</p>
    </div>
    <div class="col-md-6">
        <br>
        <h2>Order Summary</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach(session('cart') as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>Rp {{ $details['price'] }}</td>
                        <td>{{ $details['qty'] }}</td>
                        <td>Rp {{ number_format($details['price'] * $details['qty'], 2) }}</td>
                    </tr>
                    @php
                        $totalPrice += $details['price'] * $details['qty'];
                    @endphp
                @endforeach
                <tr>
                    <td colspan="3" class="text-right"><strong>Total Price:</strong></td>
                    <td>Rp {{ number_format($totalPrice, 2) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('place.order', ['orderId' => $orderID]) }}" class="btn btn-success">Place Order</a>
        <div class="col-md-6">
    </div>

    </div>
</div>

@endsection
