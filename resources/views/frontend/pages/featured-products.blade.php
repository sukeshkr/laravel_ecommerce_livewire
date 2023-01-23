@extends('layouts.frontend')

@section('title','Featured Products')
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrivals</h4>
                <div class="underline mb-4"></div>
            </div>
            @forelse ($featuredProducts as $product)
            <div class="col-md-3">
                <div class="product-card">
                        <div class="product-card-img">
                            <label class="stock bg-success">New</label>
                            @if ($product->productImages->count() > 0 )
                            <a href="{{route('product.view',['category_slug'=>$product->category->slug,'product_slug'=>$product->slug])}}">
                                <img src="{{asset('uploads/products/'.$product->productImages[0]->image)}}" alt="{{$product->name}}">
                            </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{$product->brandName->name}}</p>
                            <h5 class="product-name">
                            <a href="{{route('product.view',['category_slug'=>$product->category->slug,'product_slug'=>$product->slug])}}">
                                {{$product->name}}
                            </a>
                            </h5>
                            <div>
                                <span class="selling-price">₹{{$product->selling_price}}</span>
                                <span class="original-price">₹{{$product->original_price}}</span>
                            </div>
                            <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                <a href="" class="btn btn1"> View </a>
                            </div>
                        </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 p-2">
                <h4>No Data available</h4>
            </div>
            @endforelse

            <div class="col-md-12 text-center">
                <a href="{{route('collections')}}" class="btn btn-success px-3">View More</a>
            </div>

        </div>
    </div>
</div>


@endsection
