@extends('layouts.frontend')

@section('title','Search Result')
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>Search Result</h4>
                <div class="underline mb-4"></div>
            </div>

            @forelse ($searchProducts as $product)
            <div class="col-md-10">
                <div class="product-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-card-img">
                                <label class="stock bg-success">New</label>
                                @if ($product->productImages->count() > 0 )
                                <a href="{{route('product.view',['category_slug'=>$product->category->slug,'product_slug'=>$product->slug])}}">
                                    <img src="{{asset('uploads/products/'.$product->productImages[0]->image)}}" alt="{{$product->name}}">
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="product-card-body">
                                <p class="product-brand">{{$product->brandName->name}}</p>
                                <h5 class="product-name">
                                <a href="{{route('product.view',['category_slug'=>$product->category->slug,'product_slug'=>$product->slug])}}">
                                    {{$product->name}}
                                </a>
                                </h5>
                                <div>
                                    <span class="selling-price">₹ {{$product->selling_price}}</span>
                                    <span class="original-price">₹ {{$product->original_price}}</span>
                                </div>
                                <p style="height:45px;overflow:hidden;">
                                    {{$product->description}}
                                </p>
                                <div class="mt-2">
                                    <a href="" class="btn btn1">Add To Cart</a>
                                    <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                    <a href="" class="btn btn1"> View </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 p-2">
                <h4>No Such Product Found</h4>
            </div>
            @endforelse
            <div>
                {{$searchProducts->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
