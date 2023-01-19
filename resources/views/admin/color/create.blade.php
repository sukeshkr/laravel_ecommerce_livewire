@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Colors</h4>
                <a href="{{route('colors')}}" class="btn btn-primary text-white float-end btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{route('color.post')}}" method="POST">
                    @csrf
                    @if (session('message'))
                        <div class="alert alert-success">{{session('message')}}</div>
                    @endif
                    @error('status')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <label>Color Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                    </div>
                    <div class="mb-3">
                        <label>Color Code</label>
                        <input type="text" name="code" class="form-control  @error('code') is-invalid @enderror">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" value="1">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-float">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
