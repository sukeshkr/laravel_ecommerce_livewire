@extends('layouts.frontend')

@section('title','My order Details')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">

                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                        <a href="{{route('order')}}" class="btn btn-danger btn-sm">Back</a>
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order ID: {{$order->id}}</h6>
                            <h6>Tracking ID: {{$order->tracking_no}}</h6>
                            <h6>Ordered Date: {{$order->created_at->format('d-M-Y')}}</h6>
                            <h6>Payment Mode: {{$order->payment_mode}}</h6>
                            <h6>Order Status: {{$order->status_message}}</h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>Name: {{$order->fullname}}</h6>
                            <h6>Email: {{$order->email}}</h6>
                            <h6>Phone: {{$order->phone}}</h6>
                            <h6>Address: {{$order->address}}</h6>
                            <h6>PinCode: {{$order->pin}}</h6>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <h5>Order Items</h5>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Slno</th>
                                    <th>Item ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($order->orderItems as $orderItems)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td width=10%>{{$orderItems->id}}</td>
                                    <td width=10%>
                                    @if ($orderItems->product->productImages)
                                        <img src="{{asset('uploads/products/'.$orderItems->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                    @endif
                                    </td>
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
                                    <td colspan="6">Total Amount</td>
                                    <td colspan="1">{{$totalPrice}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
