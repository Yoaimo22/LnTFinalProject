@extends('layouts.main')


@section('container')

<h1>New Category</h1>

<form action = "/store-category" method = "POST" class="mt-5">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">New Product Category</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "name" value = "{{ old('name') }}">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection