<h1>edit</h1>
@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Category</h4>
                <a href="{{route('admin.category')}}" class="btn btn-primary text-white float-end btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{route('category.update')}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf

                    <input type="hidden" name="id" value="{{$category->id}}">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" value="{{old('name',$category->name)}}" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Name">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Slug</label>
                            <input type="text" name="slug" value="{{old('slug',$category->slug)}}" class="form-control @error('slug') is-invalid @enderror" id="exampleInputEmail3" placeholder="Slug">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="exampleInputPassword4">Status</label>
                            <input type="checkbox" name="status" {{$category->status== 1 ? 'checked' : '' }}>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>File upload</label>
                            <div class="input-group col-xs-12">
                                <img height="60" width="90" src="{{asset('uploads/category/'.$category->image)}}">
                                <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="exampleTextarea1" rows="4">{{$category->description}}</textarea>
                        </div>
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Meta Title</label>
                            <input type="text" name="meta_title" value="{{old('meta_title',$category->meta_title)}}" class="form-control @error('meta_title') is-invalid @enderror" id="exampleInputEmail3" placeholder="Slug">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" id="exampleTextarea1" rows="4">{{$category->meta_keyword}}</textarea>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="exampleInputCity1">Meta Description</label>
                            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="exampleTextarea1" rows="4">{{$category->meta_description}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary float-end me-2">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
