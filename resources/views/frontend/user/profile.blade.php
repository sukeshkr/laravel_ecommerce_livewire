@extends('layouts.frontend')

@section('title','user profile')
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>User Profile
                    <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm float-end">Change Password</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            <div class="col-md-10">
                @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif
                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>

                @endif
                <div class="card shadow">
                    <div class="crd-header bg-primary">
                        <h4 class="mb-0 text-white">User Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.profile.update')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>User Name</label>
                                        <input type="text" name="name" readonly value="{{Auth::user()->name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Email </label>
                                        <input type="text" name="email" readonly value="{{Auth::user()->email}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Phone </label>
                                        <input type="text" name="phone" value="{{Auth::user()->userDetail->phone}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>PinCode </label>
                                        <input type="text" name="pin" value="{{Auth::user()->userDetail->pin}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Address </label>
                                        <textarea name="address"  rows="5" class="form-control">{{Auth::user()->userDetail->address}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save Data</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
