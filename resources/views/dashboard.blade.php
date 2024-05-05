@extends('layouts.main')

@section('container')


<h1>Latest Products</h1>

<br>

<div class = "row">
    @foreach($products as $product)
        <div class = "col-md-3 col-6 mb-4">
            <div class = "card">
                <img src="{{ asset('/storage/product_images/'.$product->image) }}" alt="{{ $product->name }} Photo" style = "display=block; margin: 0 auto;" width = "225" height = "225">
                <div class="class-body">
                    <a href="/display-product/{{ $product['id'] }}"><h4>{{ $product['name'] }}</h4></a> 
                    <!-- <h4 class = "card-title">{{ $product['name'] }}</h4> -->
                    <p>Price: {{ 'Rp ' . number_format($product['price'],2,',','.') }}</p>
                    @if($product->amount > 0)
                        <p>Stock: {{ number_format($product['amount'], 0, '.', '.') }}</p>
                    @else
                        <p>Stock: Sold Out</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection