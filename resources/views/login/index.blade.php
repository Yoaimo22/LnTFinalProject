@extends('layouts.main')


@section('container')
<h1 class="mb-4">Login</h1>

<form action = "/login" method = "POST">
    @csrf
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
    <button type="submit" class="btn btn-primary">Login!</button>
    <small class="mt-3" style="display:block">Don't have an account yet? <a href="/register">Register Here!</a></small>
</form>

@endsection