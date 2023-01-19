@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Category</h4>
                <a href="{{route('admin.category')}}" class="btn btn-primary text-white float-end btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{route('post.category')}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf

                    @if (session('message'))
                        <div class="btn btn-success btn-sm">{{session('message')}}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Name">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Slug</label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="exampleInputEmail3" placeholder="Slug">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="exampleInputPassword4">Status</label>
                            <input type="checkbox">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>File upload</label>
                            <div class="input-group col-xs-12">
                                <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="exampleTextarea1" rows="4"></textarea>
                        </div>
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" id="exampleInputEmail3" placeholder="Slug">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" id="exampleTextarea1" rows="4"></textarea>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="exampleInputCity1">Meta Description</label>
                            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="exampleTextarea1" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary float-end me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
