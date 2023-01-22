<div>
    <div class="row">

        <div class="col-md-2">
            <div class="card">
                <div class="card-header"><h4>Brands</h4></div>
                <div class="card-body">
                    @foreach ($category->brands as $brandItem)
                        <label class="d-block"></label>
                        <input type="checkbox" wire:model="brandInputs" value="{{$brandItem->id}}" /> {{$brandItem->name}}
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h4>Price</h4></div>
                <div class="card-body">
                        <label class="d-block"></label>
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" /> High to Low
                        <label class="d-block"></label>
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" /> Low to High
                </div>
            </div>

        </div>

        <div class="col-md-10">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($product->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif
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
                <div class="col-md-3">
                    <div class="p-2">
                        <h4>No Data available of {{$category->name}}</h4>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

