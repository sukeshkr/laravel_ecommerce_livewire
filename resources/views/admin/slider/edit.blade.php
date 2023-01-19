@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Slider</h4>
                <a href="{{route('admin.slider')}}" class="btn btn-primary text-white float-end btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{route('slider.update',$slider->id)}}" method="POST" enctype = "multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if (session('message'))
                        <div class="alert alert-success">{{session('message')}}</div>
                    @endif
                    @error('status')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="{{old('title',$slider->title)}}" class="form-control @error('title') is-invalid @enderror">
                    </div>
                    <div class="mb-3">
                        <img src="{{asset('uploads/slider/'.$slider->image)}}" height="100" width="100">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="exampleTextarea1" rows="4">{{$slider->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" {{$slider->status == 1 ? 'checked' : ''}} value="1">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-float">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
