@extends('layouts.frontend')

@section('title','Thankyou shopping')

@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if (session('message'))
                        <h5 class="alert alert-success">{{session('message')}}</h5>
                    @endif
                <div class="p-4 shadow bg-white">
                    <h2>your logo</h2>
                    <h4>Thankyou for shopping mycommerse</h4>
                    <a href="{{route('collections')}}" class="btn btn-primary">Shop more</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
