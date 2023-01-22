<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice # {{$order->id}}</title>
    <style>
        body{
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">Sukesh Ecomm</h1>
                </div>
                <div class="col-6">
                    <div class="company-details">
                        <p class="text-white">Order ID: {{ $order->id }}</p>
                        <p class="text-white">Date: {{ date('D-M-Y') }}</p>
                        <p class="text-white">{{ $order->address }}</p>
                        <p class="text-white">{{ $order->phone }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No.: {{$order->id}}</h2>
                    <p class="sub-heading">Tracking No. {{$order->tracking_no}} </p>
                    <p class="sub-heading">Order Date: {{$order->created_at->format('d-m-Y h:i:A')}} </p>
                    <p class="sub-heading">Email Address: {{$order->email}} </p>
                </div>
                <div class="col-6">
                    <p class="sub-heading">Full Name:  {{$order->fullname}}</p>
                    <p class="sub-heading">Address:  {{$order->address}}</p>
                    <p class="sub-heading">Phone Number:  {{$order->phone}}</p>
                    <p class="sub-heading">City,State,Pincode:  {{$order->pin}}</p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Slno</th>
                        <th>Product</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($order->orderItems as $orderItems)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                        {{ $orderItems->product->name }}
                        @if ($orderItems->productColor)
                            <span>{{$orderItems->productColor->color->name}} color</span>
                        @endif
                        </td>
                        <td width=10%>{{$orderItems->price}}</td>
                        <td width=10%>{{$orderItems->quantity}}</td>
                        <td width=10%>{{$orderItems->price * $orderItems->quantity}}</td>
                    </tr>
                    @php
                        $totalPrice += $orderItems->price * $orderItems->quantity;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="4" class="fw-bold">Grandtotal</td>
                        <td colspan="1" class="fw-bold">{{$totalPrice}}</td>
                    </tr>
                </tbody>

            </table>
            <br>
            <h3 class="heading">Payment Status: {{$order->status_message}}</h3>
            <h3 class="heading">Payment Mode: {{$order->payment_mode}}</h3>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2022 - Sukesh kr All rights reserved.
                <a href="https://www.fundaofwebit.com/" class="float-right">www.sukesh.com</a>
            </p>
        </div>
    </div>

</body>
</html>
