@extends('layouts.main')


@section('container')
<h1 class="mb-4">Register</h1>

<form action = "/register" method = "POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name = "name" value = "{{ old('name') }}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-mail</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name = "email" value = "{{ old('email') }}">
      @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name = "password" value = "{{ old('password') }}">
      @error('password')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name = "address" value = "{{ old('address') }}">
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="phonenum" class="form-label">Phone number</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name = "phonenum" value = "{{ old('phonenum') }}">
        @error('phonenum')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="postalcode" class="form-label">Postal Code</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name = "postalcode" value = "{{ old('postalcode') }}">
        @error('postalcode')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
@endsection