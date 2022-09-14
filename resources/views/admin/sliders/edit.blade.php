@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12 ">
            @if(session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Add Sliders
                        <a href="{{route('admin.sliders')}}" class="btn btn-sm btn-primary float-end">Back
                            Slider</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.sliders.update',$slider->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <lable>Title</lable>
                                <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                                @error('title') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <lable>Image</lable>
                                <input type="file" class="form-control" name="image">
                                <img src="{{asset('upload/slider/'.$slider->image)}}" style="width: 120px;height: 150px" alt="">
                                @error('image') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <lable>Title</lable>
                                <textarea name="description" class="form-control" id=""  rows="4">{{$slider->description}}</textarea>
                                @error('description') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <lable>Status</lable>
                                <br>
                                <input type="checkbox" name="status" {{$slider->status=='1'?'checked':''}} style="width: 25px;height: 25px" >
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
