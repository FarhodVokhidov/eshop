<div wire:ignore.self class="modal fade" id="addBrandModel" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brands Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="StoreBrand">
                <div class="modal-body">
                    <div class="mb-3">
                        <lablel>Select Category</lablel>
                        <select wire:model.defer="category_id" required class="form-control">
                            <option value="">__Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{$message}}</small>@enderror

                    </div>
                    <div class="mb-3">
                        <lable>Brand Name</lable>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name') <small class="text-danger">{{$message}}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <lable>Brand slug</lable>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug') <small class="text-danger">{{$message}} </small> @enderror
                    </div>
                    <div class="mb-3">
                        <lable>Brand status</lable>
                        <br>
                        <input type="checkbox" wire:model.defer="status">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Brand update model -->
<div wire:ignore.self class="modal fade" id="updateBrandModel" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brands Updated</h5>
                <button type="button" class="btn-close" wire:click="closeModel" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                Loading...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <lablel>Select Category</lablel>
                            <select wire:model.defer="category_id" required class="form-control">
                                <option value="">__Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                            </select>
                            @error('category_id') <small class="text-danger">{{$message}}</small>@enderror

                        </div>
                        <div class="mb-3">
                            <lable>Brand Name</lable>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name') <small class="text-danger">{{$message}}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <lable>Brand slug</lable>
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug') <small class="text-danger">{{$message}} </small> @enderror
                        </div>
                        <div class="mb-3">
                            <lable>Brand status</lable>
                            <br>
                            <input type="checkbox" wire:model.defer="status" style="width: 30px;height: 30px">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" wire:click="closeModel" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="deleteBrandModel" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brands Delete</h5>
                <button type="button" class="btn-close" wire:click="closeModel" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyBrand">
            <div class="modal-body">
                <h4>Are you sure you want to delete this Data ? </h4>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click="closeModel" class="btn btn-secondary" data-bs-dismiss="modal">Close
                </button>
                <button type="submit" class="btn btn-danger">Yes Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>

