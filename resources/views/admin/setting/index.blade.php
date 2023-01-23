@extends('layouts.admin')

@section('title','admin settings')


@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
        @endif
        <form action="{{route('post.setting')}}" method="POST">
            @csrf

            <div class="card-mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Website Name</label>
                            <input type="text" name="website_name" value="{{old('website_name',$setting->website_name)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website URL</label>
                            <input type="text" name="website_url" value="{{old('website_url',$setting->website_url)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Page Title</label>
                            <input type="text" name="title" value="{{old('title',$setting->title)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control">{{old('meta_keyword',$setting->meta_keyword)}}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" cols="10" class="form-control">{{old('meta_description',$setting->meta_description)}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control">{{old('address',$setting->address)}}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone 1</label>
                            <input type="text" name="phone1" value="{{old('phone1',$setting->phone1)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone 2</label>
                            <input type="text" name="phone2" value="{{old('phone2',$setting->phone2)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email 1</label>
                            <input type="text" name="email1" value="{{old('email1',$setting->email1)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email 2</label>
                            <input type="text" name="email2" value="{{old('email2',$setting->email2)}}" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website Social Media</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>FaceBook</label>
                            <input type="text" name="faceBook" value="{{old('faceBook',$setting->faceBook)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Twitter</label>
                            <input type="text" name="twitter" value="{{old('twitter',$setting->twitter)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Instgram</label>
                            <input type="text" name="instgram" value="{{old('instgram',$setting->instgram)}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Youtube</label>
                            <input type="text" name="youtube" value="{{old('youtube',$setting->youtube)}}" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Setting</button>

            </div>

        </form>
    </div>
</div>
@endsection
