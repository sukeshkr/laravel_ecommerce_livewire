@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Products</h4>
                <a href="{{route('product.create')}}" class="btn btn-primary text-white float-end btn-sm">Add Product</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)

                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->category->name}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->selling_price}}</td>
                            <td>{{$data->quantity}}</td>
                            <td>{{$data->status ==1 ? 'Visible' : 'Hidden'}}</td>
                            <td>
                                <a href="{{route('product.edit',$data->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('product.delete',$data->id)}}" onclick="return confirm('Are You sure delete this?')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7">No data Available</td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
