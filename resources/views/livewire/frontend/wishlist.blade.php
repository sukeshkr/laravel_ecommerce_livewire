<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($wishList as $wishListItem)

                            @if ($wishListItem->product)

                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{route('product.view',['category_slug'=>$wishListItem->product->category->slug,'product_slug'=>$wishListItem->product->slug])}}">
                                            <label class="product-name">
                                                <img src="{{asset('uploads/products/'.$wishListItem->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="{{$wishListItem->product->name}}">
                                                {{$wishListItem->product->name}}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">₹ {{$wishListItem->product->selling_price}} </label>
                                    </div>
                                    <div class="col-md-2 col-12 my-auto">
                                        <div class="remove">
                                            <button wire:click="removeWishListItem({{ $wishListItem->id }})" type="button" class="btn btn-danger btn-sm">
                                                <span wire:loading.remove>
                                                    <i class="fa fa-trash"></i> Remove </span>
                                                <span wire:loading wire:target="removeWishListItem">Removing</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif

                        @empty

                        <h4>No wish list Added</h4>

                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
