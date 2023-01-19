@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Color List</h4>
                <a href="{{route('color.create')}}" class="btn btn-primary text-white float-end btn-sm">Add Color</a>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($colors as $color)
                        <tr>
                            <td>{{$color->id}}</td>
                            <td>{{$color->name}}</td>
                            <td>{{$color->code}}</td>
                            <td>{{$color->status ==1 ? 'Visible' : 'Hidden'}}</td>
                            <td>
                                <a href="{{route('color.edit',$color->id)}}" class="btn btn-info btn-float">Edit</a>
                                <a href="{{route('color.delete',$color->id)}}" onclick="return confirm('Are you sure want to delete?')" class="btn btn-danger btn-float">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                        <td colspan="5">No data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
