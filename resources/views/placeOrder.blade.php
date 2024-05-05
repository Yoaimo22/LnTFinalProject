@extends('layouts.main')

@section('container')
<br><br>

<div style="text-align: center;">
    <h2 style="font-size: 28px font-weight: bold;">Thank You For Shopping with Us</h2>

    <div class="mt-5">
        <a href="{{ route('view.invoice', ['orderId' => $orderID]) }}" class="btn btn-success btn-lg" style="margin-right: 20px;">View Invoice</a>
        <a href="{{ route('download.invoice', ['orderId' => $orderID]) }}" class="btn btn-info btn-lg">Download Invoice</a>
        <a href="{{ route('clear', ['orderId' => $orderID]) }}" class="btn btn-info btn-lg">Back to Home</a>
    </div>
    </div>
</div>


@endsection


