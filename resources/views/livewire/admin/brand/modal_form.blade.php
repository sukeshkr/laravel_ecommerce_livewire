<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Brands</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent = "storeBrand()">
            <div class="form-group">
              <label>Brand Name</label>
              <input type="text" wire:model.defer="brand_name" class="form-control @error('brand_name') is-invalid @enderror">
            </div>
            <div class="form-group">
                <label>Brand Slug</label>
                <input type="text" wire:model.defer="brand_slug" class="form-control @error('brand_slug') is-invalid @enderror">
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="checkbox" wire:model.defer="status">
                @error('status')
                    {{$message}}
                @enderror
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<!-- end -->

<!-- Brand Update Modal   -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Brands</h5>
          <button type="button" class="close" wire:click = "closeModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
            </div>
            <div wire:loading.remove>
              <form wire:submit.prevent = "updateBrand()">
                <div class="form-group">
                  <label>Brand Name</label>
                  <input type="text" wire:model.defer="brand_name" class="form-control @error('brand_name') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label>Brand Slug</label>
                    <input type="text" wire:model.defer="brand_slug" class="form-control @error('brand_slug') is-invalid @enderror">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="checkbox" wire:model.defer="status">
                    @error('status')
                        {{$message}}
                    @enderror
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click = "closeModal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>

        </div>
      </div>
    </div>
</div>
<!-- end  -->

<!-- Delete Modal   -->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Brands</h5>
          <button type="button" class="close" wire:click = "closeModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent = "destroyBrand()">
            <div class="modal-body">
                Are you sure want to delete ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click = "closeModal" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes Delete</button>
            </div>
        </form>
      </div>
    </div>
</div>


