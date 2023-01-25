@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('status'))
            <h4 class="alert alert-success">{{session('status')}}</h4>
        @endif
        <div class="me-md-3 me-xl-5">
            <h3>Dashboard</h3>
            <p class="mb-md-0">Your Dashboard</p>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>Total Order</label>
                    <h4>{{$totalOrder}}</h4>
                    <a href="{{route('admin.orders')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>Today Order</label>
                    <h4>{{$todayOrder}}</h4>
                    <a href="{{route('admin.orders')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>This Month Order</label>
                    <h4>{{$thisMonthOrder}}</h4>
                    <a href="{{route('admin.orders')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>This Year Order</label>
                    <h4>{{$thisYearOrder}}</h4>
                    <a href="{{route('admin.orders')}}" class="text-white">View</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>Total  Products</label>
                    <h1>{{$productCount}}</h1>
                    <a href="{{route('admin.product')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Total Categories</label>
                    <h1>{{$categoryCount}}</h1>
                    <a href="{{route('admin.category')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-info text-white mb-3">
                    <label>Total Brands</label>
                    <h1>{{$brandCount}}</h1>
                    <a href="{{route('brands')}}" class="text-white">View</a>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>All  Users</label>
                    <h1>{{$totalUsersCount}}</h1>
                    <a href="{{route('admin.product')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-info text-white mb-3">
                    <label>Total  Admin</label>
                    <h1>{{$adminCount}}</h1>
                    <a href="{{route('admin.product')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>Total  Users</label>
                    <h1>{{$userCount}}</h1>
                    <a href="{{route('admin.product')}}" class="text-white">View</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
