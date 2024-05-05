<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src = "https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
  </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid ms-5">
          <a class="navbar-brand" href="#">ChipiChapa.</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link {{ ($title === 'Homepage')? 'active' : '' }}" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($title === 'Dashboard')? 'active' : '' }}" href="{{ route('dashboard') }}">Our Products</a>
              </li>
              @can('admin')
              <li class="nav-item">
                <a class="nav-link {{ ($title === 'Products')? 'active' : '' }}" href="/create-product">Add Products</a>
              </li>
              @endcan
              @can('admin')
              <li class="nav-item">
                <a class="nav-link {{ ($title === 'Category')? 'active' : '' }}" href="/create-category">Add Categories</a>
              </li>
              @endcan
              
            </ul>
            <ul class="navbar-nav ms-auto me-5">
              @auth
              @php
              $totalItems = 0;
              if(session('cart')) {
                foreach(session('cart') as $id => $details) {
                  $totalItems += $details['qty'];
                }
              }
              @endphp

              <a class="btn btn-primary" href="{{ route('shopping.cart') }}">
              <i class="bi "></i> View Cart <span class="badge bg-danger">{{  $totalItems }}</span></a> 

              <li class="nav-item">
                <form action="/logout" method="post">
                @csrf
                <a class="nav-link"><button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-right me-1"></i>Logout</button></a>
                </form>
              </li>
              @else
              <li class="nav-item">
                <a href='/login' class="nav-link"><button class="btn btn-primary"></i></i>Login!</button></a>
              </li>
              @endauth
              
            </ul>
          </div>
        </div>
      </nav>

      <div class="container mt-5">
        @yield('container')
      </div>

@yield('scripts')
</body>
<!-- @if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
@endif -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
