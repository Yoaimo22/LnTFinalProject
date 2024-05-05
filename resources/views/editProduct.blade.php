@extends('layouts.main')


@section('container')

<h1>Edit Products</h1>

<form action = "/update-product/{{ $product->id }}" method = "POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name = "name" value = "{{ old('name', $product->name) }}">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Product Price</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name = "price" value = "{{ old("price", $product->price) }}">
      @error('price')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Product Amount</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name = "amount" value = "{{ old("amount", $product->amount) }}">
      @error('amount')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection