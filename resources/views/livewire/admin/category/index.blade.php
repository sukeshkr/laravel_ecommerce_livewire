
<div>
    <div wire:ignore.self id="deleteModal" class="modal fade bd-example-modal-sm delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="destroyCategory">
                <div class="modal-body">
                    <h6>Are you sure want to delete this ?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Category</h4>
                <a href="{{route('category.create')}}" class="btn btn-primary float-end btn-sm">Add Category</a>
            </div>
            <div class="card-body">

                @if (session('message'))
                    <h4 class="btn btn-success btn-sm">{{session('message')}}</h4>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)

                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->status == 1 ? 'Hidden' : 'Visible'}}</td>
                                <td>
                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="#" wire:click="deleteCategory({{$category->id}})" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#deleteModal">Delete</a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div>
                    {{$categories->links()}}

                </div>

            </div>
        </div>
    </div>
</div>
</div>
@push('script')
<script>
    document.addEventListener('close-modal',event=>{

        $("#deleteModal").modal('hide');

    });
</script>
@endpush


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

