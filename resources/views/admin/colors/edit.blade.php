@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h3>Add Colors
                        <a href="{{url('admin/colors/')}}" class="btn btn-sm btn-primary float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/colors/'.$color->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Color name</label>
                                <input type="text" value="{{$color->name}}" name="name" class="form-control  shadow">
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Code</label>
                                <input type="text" name="code" value="{{$color->code}}" class="form-control  shadow">
                                @error('slug') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <input type="checkbox" {{$color->status=='1'?'checked':''}} width="60" height="100" name="status">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Updated</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
