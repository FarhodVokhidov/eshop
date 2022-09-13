@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Prodcusts
                        <a href="{{url('admin/products')}}" class="btn btn-sm btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <h4 class="alert-success alert " >{{session('message')}}</h4>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-warning">
                            @foreach($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{route('admin.product.update',$product)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                        data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                        aria-controls="seotag-tab-pane" aria-selected="false">Seo Tags
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details-tab-pane" type="button" role="tab"
                                        aria-controls="details-tab-pane" aria-selected="false">Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                        data-bs-target="#image-tab-pane" type="button" role="tab"
                                        aria-controls="image-tab-pane" aria-selected="false">Product Image
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                                        data-bs-target="#color-tab-pane" type="button" role="tab"
                                        aria-controls="color-tab-pane" aria-selected="false">Colors Product
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" cla id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                 aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <lable>Category</lable>
                                    <select name="category_id" class="form-control shadow" id="">
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{$category->id==$product->category->id ? 'selected':''}} >
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <lable>Product name</lable>
                                    <input type="text" value="{{$product->name}}" name="name"
                                           class="form-control shadow">
                                    @error('name')
                                    <smoll class="text-danger">{{$message}}</smoll> @enderror
                                </div>
                                <div class="mb-3">
                                    <lable>Product slug</lable>
                                    <input type="text" name="slug" value="{{$product->slug}}"
                                           class="form-control shadow">
                                    @error('slug')
                                    <smoll class="text-danger">{{$message}}</smoll> @enderror
                                </div>
                                <div class="mb-3">
                                    <lable>Brand</lable>
                                    <select name="brand" class="form-control shadow" id="">
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{$brand->name}}" {{$brand->name==$product->brand ? 'selected':''}}>
                                                {{$brand->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <lable>Small Description (500 words)</lable>
                                    <textarea name="small_description" class="form-control shadow"
                                              rows="4"> {{$product->small_description}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <lable>Description</lable>
                                    <textarea name="description" class="form-control shadow"
                                              rows="4">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel"
                                 aria-labelledby="seotag-tab"
                                 tabindex="0">
                                <div class="mb-3">
                                    <lable>Meta title</lable>
                                    <input type="text" name="meta_title" value="{{$product->meta_title}}"
                                           class="form-control shadow">
                                </div>
                                <div class="mb-3">
                                    <lable>Meta Keyword</lable>
                                    <textarea name="meta_keyword" class="form-control shadow"
                                              rows="4">{{$product->meta_keyword}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <lable>Meta Description</lable>
                                    <textarea name="meta_description" class="form-control shadow"
                                              rows="4">{{$product->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                 aria-labelledby="details-tab"
                                 tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Original price</lable>
                                            <input type="text" value="{{$product->original_price}}"
                                                   name="original_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Selling price</lable>
                                            <input type="text" value="{{$product->selling_price}}" name="selling_price"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Quantity</lable>
                                            <input type="number" value="{{$product->quantity}}" name="quantity"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Trending</lable>
                                            <input type="checkbox"
                                                   {{$product->trending == '1'?'checked':''}} name="trending"
                                                   style="width: 40px;height:40px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Status</lable>
                                            <input type="checkbox"
                                                   {{$product->status == '1'?'checked':''}} name="status"
                                                   style="width: 40px;height:40px">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                 aria-labelledby="image-tab"
                                 tabindex="0">
                                <div class="mb-3">
                                    <lable>Upload Product Image</lable>
                                    <input type="file" name="image[]" multiple class="form-control shadow">
                                </div>
                                <div>
                                    @if($product->productImages)
                                        <div class="row">
                                            @foreach($product->productImages as $image)
                                            <div class="col-md-2">
                                                <img src="{{asset($image->image)}}" style="width: 120px;height: 140px"
                                                     class="border shadow" alt="">
                                                <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="btn btn-danger btn-sm">Remove</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5>No images</h5>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel"
                                 aria-labelledby="color-tab"
                                 tabindex="0">
                                <div class="mb-3">
                                    <lable>Upload Product Image</lable>
                                    <input type="file" name="image[]" multiple class="form-control shadow">
                                </div>
                                <div>
                                    @if($product->productImages)
                                        <div class="row">
                                            @foreach($product->productImages as $image)
                                            <div class="col-md-2">
                                                <img src="{{asset($image->image)}}" style="width: 120px;height: 140px"
                                                     class="border shadow" alt="">
                                                <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="btn btn-danger btn-sm">Remove</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5>No images</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
