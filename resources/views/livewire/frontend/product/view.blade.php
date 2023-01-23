<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">

            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success btn-sm">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                        {{-- <img src="{{asset('uploads/products/'.$product->productImages[0]->image)}}" class="w-100" alt="Img"> --}}

                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                              <ul class='exzoom_img_ul'>
                                @foreach ($product->productImages as $imagesItem)
                                <li><img src="{{asset('uploads/products/'.$imagesItem->image)}}"/></li>
                                @endforeach
                              </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                          </div>
                        @else
                        No image
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">

                        <h4 class="product-name">
                            {{$product->name}}
                        </h4>
                        <hr>
                        <p class="product-path"> Home / {{$product->category->name}} / {{$product->name}}</p>
                        <p class="product-path">Brand: {{$product->brandName->name}}</p>
                        <div>
                            <span class="selling-price">${{$product->selling_price}}</span>
                            <span class="original-price">${{$product->original_price}}</span>
                        </div>
                        <div>
                            @if ($product->productColors->count() > 0)

                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        {{-- <input type="radio" name="colorSelection" value="{{$colorItem->id}}"> {{$colorItem->color->name}} --}}
                                        <label class="colorSelectionLabel" style="background-color: {{$colorItem->color->code}}" wire:click="colorSelected({{$colorItem->id}})">
                                        o
                                        </label>
                                    @endforeach
                                @endif

                                <div>
                                @if ($this->porductColorSelectedQty == 'outOfStock')
                                    <label class="btn-sm py-1 text-white bg-danger">Out of Stock</label>
                                @elseif ($this->porductColorSelectedQty > 0)
                                    <label class="btn-sm py-1 text-white bg-success">In Stock</label>
                                @endif
                                </div>

                            @else

                                @if ($product->quantity)
                                <label class="btn-sm py-1 text-white bg-success">In Stock</label>
                                @else
                                <label class="btn-sm py-1 text-white bg-danger">Out of Stock</label>
                                @endif

                            @endif

                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click = "decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input readonly type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" class="input-quantity" />
                                <span class="btn btn1" wire:click = "incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn1" wire:click="addToCart({{$product->id}})">
                                <span wire:loading.remove wire:target="addToCart">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </span>
                                <span wire:loading wire:target>
                                    Adding...
                                </span>
                            </button>

                            <button type="button" wire:click = "addToWishList({{$product->id}})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishList">
                                    Adding...
                                </span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{$product->small_description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{$product->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related @if ($category) {{$category->name}}
                    @endif Products</h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if ($category)
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($category->products->take(15) as $product)
                        <div class="item mb-3">
                        <div class="product-card">
                            <div class="product-card-img">
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
                    @else
                        <div class="p-2">
                            <h4>No Data available</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related @if ($product) {{$product->brandName->name}}

                    @endif Products</h3>
                    <div class="underline"></div>
                </div>
                @forelse ($category->products->take(15) as $brandProduct)
                @if ($brandProduct->brand == $product->brandName->id)

                <div class="col-md-3 mb-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if ($brandProduct->productImages->count() > 0 )
                            <a href="{{route('product.view',['category_slug'=>$brandProduct->category->slug,'product_slug'=>$brandProduct->slug])}}">
                                <img src="{{asset('uploads/products/'.$brandProduct->productImages[0]->image)}}" alt="{{$brandProduct->name}}">
                            </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{$brandProduct->brandName->name}}</p>
                            <h5 class="product-name">
                            <a href="{{route('product.view',['category_slug'=>$product->category->slug,'product_slug'=>$brandProduct->slug])}}">
                                {{$brandProduct->name}}
                            </a>
                            </h5>
                            <div>
                                <span class="selling-price">₹{{$brandProduct->selling_price}}</span>
                                <span class="original-price">₹{{$brandProduct->original_price}}</span>
                            </div>
                            <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                <a href="" class="btn btn1"> View </a>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

                @empty
                <div class="col-md-12 p-2">
                    <h4>No Data available</h4>
                </div>
                @endforelse

            </div>
        </div>
    </div>




</div>

@push('scripts')
<script>
$(function(){

    $("#exzoom").exzoom({
    // thumbnail nav options
    "navWidth": 60,
    "navHeight": 60,
    "navItemNum": 5,
    "navItemMargin": 7,
    "navBorder": 1,
    // autoplay
    "autoPlay": true,
    // autoplay interval in milliseconds
    "autoPlayTimeout": 2000
    });
});

//Owl carosel
$('.four-carousel').owlCarousel({
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
@endpush
