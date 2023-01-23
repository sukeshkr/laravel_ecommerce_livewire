@extends('layouts.admin')
@section('title','User Settings')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Users</h4>
                <a href="{{route('user')}}" class="btn btn-primary text-white float-end btn-sm">Back</a>
            </div>
            <div class="card-body">

                <form method="post" action="{{route('user.update',$user->id)}}">
                    @csrf
                    @method('PUT')
                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    @if ($errors->any())
                    <ul class="alert alert-sm alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                    </ul>
                    @endif
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{old('user',$user->name)}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" readonly value="{{old('user',$user->email)}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Select Role</label>
                            <select name="role" class="form-select">
                                <option value="">Select Role</option>
                                <option value="0" @selected(old('user',$user->role_as) == 0) >User</option>
                                <option value="1" @selected(old('user',$user->role_as) == 1)>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection
