@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category
                        <a href="{{url('admin/category/')}}" class="btn btn-sm btn-primary float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" value="{{$category->name}}" name="name" class="form-control  shadow">
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Slug</label>
                                <input type="text" value="{{$category->slug}}" name="slug" class="form-control  shadow">
                                @error('slug') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control shadow" rows="3"> {{$category->description}}</textarea>
                                @error('description') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control  shadow">
                                <img src="{{asset('/upload/category/'.$category->image)}}" width="100" height="130" alt="">
                                @error('image') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <input type="checkbox" {{$category->status == '1' ? 'checked':' ' }} width="60" height="100" name="status">
                            </div>
                            <div class="col-md-12 mb-3">
                                <h4>SEO TAGS</h4>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta_title</label>
                                <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control  shadow">
                                @error('meta_title') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta_keyword</label>
                                <textarea type="text" name="meta_keyword" rows="3" class="form-control shadow"> {{$category->meta_keyword}}</textarea>
                                @error('meta_keyword') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta_Description</label>
                                <textarea type="text" name="meta_description" class="form-control  shadow">{{$category->meta_description}}</textarea>
                                @error('meta_description') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                               <button class="btn btn-primary float-end " type="submit">
                                   Update
                               </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
