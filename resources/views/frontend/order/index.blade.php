@extends('layouts.frontend')

@section('title','My order')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4>My orders</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Order ID</th>
                                <th>Tracking Number</th>
                                <th>User Name</th>
                                <th>Payment Mode</th>
                                <th>Order Date</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @forelse ($orders as $order)

                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->tracking_no}}</td>
                                    <td>{{$order->fullname}}</td>
                                    <td>{{$order->payment_mode}}</td>
                                    <td>{{$order->created_at->format('d-M-Y')}}</td>
                                    <td>{{$order->status_message}}</td>
                                    <td>
                                        <a href="{{route('order.view',$order->id)}}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7">No Orders Available</td>
                                    <td><a href="{{route('collections')}}" class="btn btn-warning">Shop Now</a></td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>
                        <div>
                            {{$orders->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
