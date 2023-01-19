@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Products</h4>
                <a href="{{route('admin.product')}}" class="btn btn-primary text-white float-end btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->count() > 0)
                        <div class="alert alert-warning">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('message'))

                    <div class="alert alert-success">{{session('message')}}</div>

                    @endif

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                        Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">
                        SEO Tags</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">
                        Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="details" aria-selected="false">
                        Product Images</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color" type="button" role="tab" aria-controls="details" aria-selected="false">
                        Product Color</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="mb-3">
                            <label for="">Category</label>
                            <select name="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" @selected(old('category',$category->id)==$product->category_id)>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" value="{{old('name',$product->name)}}" class="form-control" placeholder="Product Name">
                        </div>
                        <div class="mb-3">
                            <label>Product Slug</label>
                            <input type="text" name="slug" value="{{old('slug',$product->slug)}}" class="form-control" placeholder="Product Slug">
                        </div>
                        <div class="mb-3">
                            <label for="">Brand</label>
                            <select name="brand" class="form-control">
                                <option value = "" >Select Brand</option>
                                @foreach ($brands as $brand)
                                <option value="{{$brand->id}}" @selected(old('brand',$brand->id)==$product->brand)>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="exampleTextarea1" rows="4">{{old('description',$product->description)}}</textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="exampleInputCity1">Small Description</label>
                            <textarea name="small_description" class="form-control @error('small_description') is-invalid @enderror" id="exampleTextarea1" rows="4">{{old('small_description',$product->small_description)}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Meta Title</label>
                            <input type="text" name="meta_title" value="{{old('meta_title',$product->meta_title)}}" class="form-control @error('meta_title') is-invalid @enderror" id="exampleInputEmail3" placeholder="Meta Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="exampleInputEmail3">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" id="exampleTextarea1" rows="4">{{old('meta_keyword',$product->meta_keyword)}}</textarea>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="exampleInputCity1">Meta Description</label>
                            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="exampleTextarea1" rows="4">{{old('meta_description',$product->meta_description)}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="details" role="tabpanel" aria-labelledby="details-tab">
                        <div class="mb-3">
                            <label>Original Price</label>
                            <input type="text" name="original_price" value="{{old('original_price',$product->original_price)}}" class="form-control" placeholder="Original Price">
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Selling Price</label>
                                <input type="text" name="selling_price" value="{{old('selling_price',$product->selling_price)}}" class="form-control" placeholder="Selling Price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Quantity</label>
                                <input type="number" name="quantity" value="{{old('quantity',$product->quantity)}}" class="form-control" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Trending</label>
                                <input type="checkbox" name="trending" {{$product->trending == 1 ? 'checked' : ''}} value="1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Status</label>
                                <input type="checkbox" name="status" {{$product->status == 1 ? 'checked' : ''}} value="1">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="images" role="tabpanel" aria-labelledby="images-tab">
                        <div class="mb-3">
                            <label>Upload Product Images</label>
                            <input type="file" name="images[]" multiple class="form-control">
                        </div>
                        <div>
                            @if ($product->productImages)
                            <div class="row">
                                @foreach ($product->productImages as $imageFile)
                                <div class="col-md-2">
                                    <img class="me-4 border" height="150" width="150" src="{{asset('uploads/products/'.$imageFile->image)}}">
                                    <a href="{{ route('pimage.delete',$imageFile->id) }}" class="d-block">remove</a>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="color" role="tabpanel" aria-labelledby="color-tab">
                        <div class="mb-3">
                            <label>Select Color</label>
                            <hr>
                            <div class="row">
                                @forelse ($colors as $color)
                                    <div class="col-md-3">
                                        <div class="p-2 border">
                                            Color :<input type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}"> {{$color->name}}
                                            <br>
                                            Quantity : <input type="number" name="color_quantity[{{$color->id}}]" style="border:1px solid">
                                        </div>
                                    </div>
                                @empty
                                <div class="col-md-12">
                                    <h4>No colors Found</h4>
                                </div>

                                @endforelse

                            </div>
                        </div>
                        <div class="table table-sm table-responsive">
                            <table class="table-bordered">
                                <thead>
                                    <tr>
                                        <th>Color Name</th>
                                        <th>Quantity</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->productColors as $prodColor)
                                        <tr class="prod-color-tr">
                                            <td>@if ($prodColor->color)
                                                {{$prodColor->color->name}}
                                                @else
                                                No color
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <input type="text" value="{{$prodColor->quantity}}" class="productColorQty form-control form-control-sm">
                                                    <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-info btn-xs">Update</button>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" value="{{$prodColor->id}}" class="deleteProductColorBtn btn btn-danger btn-xs"> Delete </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-primary btn-float">Update</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.updateProductColorBtn').click(function() {
            var prod_id = "{{$product->id}}";
            var prod_color_id = $(this).val();
            var qty = $(this).closest('.prod-color-tr').find('.productColorQty').val();
            if(qty <= 0) {
                alert("quantity is required");
                return false;
            }
            var data = {
                'prod_id': prod_id,
                'prod_color_id': prod_color_id,
                'qty': qty,
            };
            $.ajax({
                type: "POST",
                url: "{{ route('prdclr.update') }}",
                data: data,
                success: function(res) {
                    alert(res.message)
                }
            });
        });

        $('.deleteProductColorBtn').click(function() {

            var prod_color_id = $(this).val();

            var thisClick = $(this);

            var data = {
                'prod_color_id': prod_color_id,
            };
            $.ajax({
                type: "POST",
                url: "{{ route('prdclr.delete') }}",
                data: data,
                success: function(res) {
                    thisClick.closest('.prod-color-tr').remove();
                    alert(res.message)
                }
            });
        });

    });

</script>

@endsection
