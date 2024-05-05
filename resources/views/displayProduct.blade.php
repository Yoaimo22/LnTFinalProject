@extends('layouts.main')

@section('container')

<img src="{{ asset('/storage/product_images/'.$product->image) }}" alt="{{ $product->name }} Photo">
<h5>{{ $product['name'] }}</h5>
<h6>Category: {{ $product->category->name }}</h6>
<br>
<p>{{ 'Rp ' . number_format($product['price'], 2, ',', '.') }}</p>
@if($product->amount > 0)
    <p>Stock: {{ number_format($product['amount'], 0, '.', '.') }}</p>
@else
    <p>Stock: Sold Out</p>
@endif

@if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
@endif

<form action="{{ route('Add.to.cart', $product->id) }}" method="POST" onsubmit="console.log('Form submitted. Quantity: ' + this.amount.value)">
    @csrf
    @if($product->amount > 0)
        <input type="number" value="{{ $product->amount >= 1 ? 1 : $product->amount }}" min="1" max="{{ $product->amount }}" class="form-control" style="width:100px" name="amount">
        <br>
        <input type="hidden" value="{{$product->id}}" name="product_id">
        <p class="btn-holder">
            <button type="submit" class="btn btn-outline-danger">Add to Cart</button>
        </p>
    @endif
</form>

<a href="/dashboard" class="btn btn-warning">Back</a>

@can('admin')
    <form action="/delete-product/{{ $product->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
    </form>

    <a href="/edit-product/{{ $product->id }}"><button type="button" class="btn btn-warning mt-2">Edit</button></a>
@endcan

@endsection
