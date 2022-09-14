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
                        <a href="{{route('admin.sliders.create')}}" class="btn btn-sm btn-primary float-end">Add
                            Slider</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{$slider->id}}</td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->description}}</td>
                                <td><img src="{{asset('upload/slider/'.$slider->image)}}" alt=""></td>
                                <td>{{$slider->status == true ?'Visible':'Hidden'}}</td>
                                <td>
                                    <a href="{{route('admin.sliders.edit',$slider->id)}}"
                                       class="btn btn-success">Edit</a>
                                    <a href="{{route('admin.sliders.destroy',$slider->id)}}" onclick="return confirm('Are you sure delete want to delete this Slider')"
                                       class="btn btn-danger">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
