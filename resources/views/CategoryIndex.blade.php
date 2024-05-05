@extends('layouts.main')

@section('container')


<h1>Categories</h1>
@foreach($categories as $category)
<br>
<a><h4>Category Name: {{ $category['name'] }}</h4></a>
@endforeach


@endsection