@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Slider List</h4>
                @if (session('message'))
                <h5 class="alert alert-success alert-sm">{{session('message')}}</h5>
                @endif
                <a href="{{route('slider.create')}}" class="btn btn-primary text-white float-end btn-sm">Add Slider</a>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->description}}</td>
                            <td><img src="{{asset('uploads/slider/'.$slider->image)}}" ></td>
                            <td>{{$slider->status ==1 ? 'Visible' : 'Hidden'}}</td>
                            <td>
                                <a href="{{route('slider.edit',$slider->id)}}" class="btn btn-info btn-float">Edit</a>
                                <a href="{{route('slider.delete',$slider->id)}}" onclick="return confirm('Are you sure want to delete?')" class="btn btn-danger btn-float">Delete</a>
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
