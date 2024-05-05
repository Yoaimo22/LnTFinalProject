@extends('layouts.main')

@section('container')

<h1>Cart</h1>
<br><br>

<table id="cart" class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Total</th>
            <th>Amount</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPrice = 0;
        @endphp

        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php
                    $subtotal = $details['price'] * $details['qty'];
                    $totalPrice += $subtotal;
                @endphp
                <tr rowId="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{ '/storage/product_images/' }}/{{ $details['image'] }}" class="card-img-top" />
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name']}}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">Rp {{ number_format($details['price'], 2, ',', '.') }}</td>
                    <td data-th="Subtotal" class="text-center">Rp {{ number_format($subtotal, 2, ',', '.') }}</td>
                    <td data-th="Amount" class="text-center">{{ number_format($details['qty'],0, '.', '.') }}</td>
                    <td class="actions">
                        <a class="btn btn-outline-danger btn-sm delete-product"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        @if($totalPrice > 0)
        <tr>
            <td colspan="1"></td>
            <td colspan="2" class="text-right">Total Price:</td>
            <td class="text-center">Rp {{ number_format($totalPrice, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ route('check.out') }}" class="btn btn-primary">Checkout</a>
            </td>
        </tr>
        @else
        <tr>
            Add Something!!
        </tr>
        @endif
    </tfoot>
</table>

@endsection

@section('scripts')

<script type="text/javascript">
    $(".delete-product").click(function (e) {
        e.preventDefault();
        var ele = $(this);

        if (confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{route('delete.cart.product')}}',
                method: "DELETE",

                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>

@endsection
