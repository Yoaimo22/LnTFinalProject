@extends('layouts.main')

@section('container')
    <h1>Welcome </h1>

    <br><br>

    <?php 
        $dat = new DateTime('now', new DateTimeZone('Asia/Bangkok'));
        $hour = $dat->format('H');
        $greeting = '';

        if ($hour < 12) 
            $greeting = "Good morning"; 
        elseif ($hour < 17) 
            $greeting = "Good afternoon";
        elseif ($hour < 20)
            $greeting = "Good evening"; 
        else 
            $greeting = "Good night"; 
    ?>

    @auth
        <h2 class="greeting">{{ $greeting }}, {{ Auth::user()->name }}</h2>
    @else
        <h2 class="greeting">{{ $greeting }}</h2>
    @endauth

    <style>
        .greeting {
            font-size: 24px;
            font-weight: bold; 
            color: #333; 
        }
    </style>
@endsection
