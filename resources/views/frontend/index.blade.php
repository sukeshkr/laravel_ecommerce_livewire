@extends('layouts.frontend')

@section('title','Home Page')

@section('content')

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

        @foreach ($sliders as $key => $slider)
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                <img class="d-block w-100" src="{{asset('uploads/slider/'.$slider->image)}}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="custom-carousel-content">
                        <h5>{{$slider->title}}</h5>
                        <p>{{$slider->description}}</p>
                        <div>
                            <a href="#" class="btn btn-slider">
                                Get Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Welcome to my Sukesh Website</h4>
                <div class="underline" mx-auto></div>
                <p>
                    Ecommerce or electronic commerce is the trading of goods and services on the internet.
                    It is your bustling city center or brick-and-mortar shop translated into zeroes and ones on the internet
                    superhighway.
                </p>
            </div>
        </div>
    </div>
  </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline mb-4"></div>
                </div>
                @if ($trendingProduct)
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme trending-product">
                        @foreach ($trendingProduct as $product)
                        <div class="item">
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
                        @endforeach
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Data available</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection


@section('scripts')
<script>
    $('.trending-product').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection
