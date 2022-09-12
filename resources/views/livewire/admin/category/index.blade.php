<div>


    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent ="destroyCategory">
                    <div class="modal-body">
                        <h6>Are you sure you want to delete this data?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 ">
            @if(session('message'))
                <div class="alert alert-success">
                    <h5>{{session('message')}}</h5>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{url('admin/category/create')}}" class="btn btn-sm btn-primary float-end">Add
                            Category</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>Image</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td><img src="{{asset('upload/category/'.$category->image)}}" alt=""></td>
                                <td>{{$category->status == '1'?'Hidden':'Visible' }}</td>
                                <td>
                                    <a href="{{url('admin/category/'.$category->id.'/edit')}}"
                                       class="btn btn-success shadow">Edit</a>
                                    <a href="#" wire:click="deleteCategory({{$category->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger" >Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

{{--@push('script')--}}
{{--    <script>--}}
{{--        windows.addEventListener('close-modal',event=>{--}}
{{--            $('#deleteModal').modal('hide');--}}
{{--        })--}}
{{--    </script>--}}

{{--@endpush--}}
