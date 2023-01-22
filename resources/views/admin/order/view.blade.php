@extends('layouts.admin')

@section('title','Order Details')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))

        <div class="alert alert-success">{{session('message')}}</div>

        @endif
        <div class="card border mt-3">
            <div class="card-header">
                <h4>My Order Details</h4>
            </div>
            <div class="card-body">
                <div class="shadow bg-white p-3">

                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                        <a href="{{route('admin.orders')}}" class="btn btn-danger btn-sm">Back</a>
                        <a href="{{route('admin.invoice.download',$order->id)}}" class="btn btn-primary btn-sm">Download Invoice</a>
                        <a href="{{route('admin.invoice.view',$order->id)}}" target="_blank" class="btn btn-success btn-sm">View Invoice</a>
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
        <div class="card">
            <div class="card-body">
                <h4>Order Process(Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{route('admin.order.update',$order->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <label>Update Your Order Status</label>

                            <div class="input-group">

                                <select name="order_status" id="" class="form-select">
                                <option value="in progress" @selected(old('order_status',$order->status_message) == 'in progress')>In Progress</option>
                                <option value="completed" @selected(old('order_status',$order->status_message) == 'completed')>Completed</option>
                                <option value="pending" @selected(old('order_status',$order->status_message) == 'pending')>Pending</option>
                                <option value="cancelled" @selected(old('order_status',$order->status_message) == 'cancelled')>Cancelled</option>
                                <option value="out-for-delivery" @selected(old('order_status',$order->status_message) == 'out-for-delivery')>Out For Delivery</option>
                                </select>

                                <button type="submit" class="btn btn-primary text-white">Update</button>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <br>
                            <h4 class="mt-8">Current Order Status : <span class="text-uppercase">{{$order->status_message}}</span></h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
