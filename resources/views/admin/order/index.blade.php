@extends('layouts.admin')

@section('title','Orders')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>My Orders</h4>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Filter By Date</label>
                            <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Filter By Status</label>
                            <select name="status" class="form-select">
                                <option value="">Select All Status</option>
                                <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                                <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'selected' : ''}}>Out For Delivery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
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
                                    <a href="{{route('admin.order.view',$order->id)}}" class="btn btn-primary">View</a>
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
                </div>
                <div>
                {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
