@extends('layouts.main')


@section('container')

<h1>Create Product</h1>

<form action = "/store-product" method = "POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Category</label>
      <select type="text" class="form-select" id="exampleInputEmail1" aria-describedby="emailHelp" name = "category_id" value = "{{ old('name') }}">
        <option selected>Open this Select Menu</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      @error('category')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "name" value = "{{ old('name') }}">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Product Price</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name = "price" value = "{{ old('price') }}">
      @error('price')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Product Amount</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name = "amount" value = "{{ old("amount") }}">
      @error('amount')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Product Image</label>
      <input type="file" class="form-control" id="exampleInputPassword1" name = "image" value = "{{ old("image") }}">
      @error('image')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection