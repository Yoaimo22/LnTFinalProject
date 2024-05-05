<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{$orderId}}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">PT ChipiChapa</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{$orderId}}</span> <br>
                    <span>Date: {{ date('d-m-Y') }}</span> <br>
                    <span>Zip code : {{ \Illuminate\Support\Str::random(6) }}</span> <br>
                    <span>Address: Bina Nusantara University Alam Sutera</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{$orderId}}</td>

                <td>Full Name:</td>
                <td>{{Auth::user()->name}}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{ 'TR' . \Illuminate\Support\Str::random(8) }}</td>

                <td>Email Id:</td>
                <td>{{Auth::user()->email}}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ date('d-m-Y') }}</td>

                <td>Phone:</td>
                <td>{{Auth::user()->phonenum}}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>Cash on Delivery</td>

                <td>Address:</td>
                <td>{{Auth::user()->address}}</td>
            </tr>
           
        </tbody>
    </table>
        <br>
    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp
            @foreach(session('cart') as $id => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>Rp {{ $details['price'] }}</td>
                    <td>{{ $details['qty'] }}</td>
                    <td>Rp {{ number_format($details['price'] * $details['qty'], 2) }}</td>
                </tr>
                @php
                    $totalAmount += $details['price'] * $details['qty'];
                @endphp
            @endforeach            <tr>
                <td colspan="3" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                <td colspan="1" class="total-heading">Rp {{ number_format($totalAmount * 1.1, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with Raja & Co.!!!
    </p>

</body>
</html>