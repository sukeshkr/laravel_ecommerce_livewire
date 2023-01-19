<div>
@include('livewire.admin.brand.modal_form')
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Brands List</h4>
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBrandModal" data-whatever="@mdo">Add Brands</a>
            </div>
            @if (session('message'))

            <h4 class="btn btn-sucess">{{session('message')}}</h4>

            @endif
            <div class="card-body">
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->slug}}</td>
                            <td>{{$brand->status==1 ? 'Visible' : 'Hidden'}}</td>
                            <td>
                                <a href="#" wire:click = "editBrand({{$brand->id}})" class="btn btn-success btn-sm" data-toggle="modal" data-target="#updateBrandModal">Edit</a>
                                <a href="#" wire:click = "deleteBrand({{$brand->id}})" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBrandModal">Delete</a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5">No Brands Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{$brands->links()}}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@push('script')
<script>
    window.addEventListener('close-modal',event=>{

        $("#addBrandModal").modal('hide');
        $("#updateBrandModal").modal('hide');
        $("#deleteBrandModal").modal('hide');


    });
</script>
@endpush


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
