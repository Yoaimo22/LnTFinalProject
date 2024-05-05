@extends('layouts.main')

@section('container')

<h1>Name: {{ $customer->name }}</h1>

<h2>Bought: </h2>
<ul>
@foreach($customer->book as $book)
<li>{{ $book->title }}</li>
@endforeach
</ul>
@endsection