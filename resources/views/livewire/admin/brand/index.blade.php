<div>
    @include('livewire.admin.brand.modal-form')
    <div class="row">
        @if(session('message'))
            <div class="alert alert-success">
                <h5>{{session('message')}}</h5>
            </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Brands List <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModel"
                                       class="btn btn-success float-end">Add Brand</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>Category</th>
                            <th>SLUG</th>
                            <th>STATUS</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                <td>
                                    @if($brand->category)
                                        {{$brand->category->name}}
                                    @else
                                        No category
                                    @endif
                                </td>
                                <td>{{$brand->slug}}</td>
                                <td>{{$brand->status == 1 ? 'Hidden':'visible'}}</td>
                                <td>
                                    <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal"
                                       data-bs-target="#updateBrandModel" class="btn btn-success">Edit</a>
                                    <a href="" wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal"
                                       data-bs-target="#deleteBrandModel" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$brands->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addBrandModel').modal('hide');
            $('#updateBrandModel').modal('hide');
            $('#deleteBrandModel').modal('hide');
        });
    </script>

@endpush
