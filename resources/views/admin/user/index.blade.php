@extends('layouts.admin')
@section('title','User Settings')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Users</h4>
                <a href="{{route('user.create')}}" class="btn btn-primary text-white float-end btn-sm">Add User</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)

                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->role_as == 1 ? 'admin' : 'user'}}</td>
                            <td>
                                <a href="{{route('user.edit',$data->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('user.delete',$data->id)}}" onclick="return confirm('Are You sure delete this?')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5">No data Available</td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>
                <div>
                    {{$datas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
