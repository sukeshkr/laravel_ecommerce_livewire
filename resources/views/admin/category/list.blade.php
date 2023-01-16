@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Category</h4>
                <a href="{{route('category.create')}}" class="btn btn-primary float-end btn-sm">Add Category</a>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

@endsection
