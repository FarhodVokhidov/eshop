@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h3>Add Prodcusts
                        <a href="{{url('admin/products')}}" class="btn btn-sm btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-warning">
                            @foreach($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <lable>Product name</lable>
                                    <input type="text" name="name" class="form-control shadow">
                                    @error('name')
                                    <smoll class="text-danger">{{$message}}</smoll> @enderror
                                </div>
                                <div class="mb-3">
                                    <lable>Product slug</lable>
                                    <input type="text" name="slug" class="form-control shadow">
                                    @error('slug')
                                    <smoll class="text-danger">{{$message}}</smoll> @enderror
                                </div>
                                <div class="mb-3">
                                    <lable>Brand</lable>
                                    <select name="brand" class="form-control shadow" id="">
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->name}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <lable>Small Description (500 words)</lable>
                                    <textarea name="small_description" class="form-control shadow" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <lable>Description</lable>
                                    <textarea name="description" class="form-control shadow" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel"
                                 aria-labelledby="seotag-tab"
                                 tabindex="0">
                                <div class="mb-3">
                                    <lable>Meta title</lable>
                                    <input type="text" name="meta_title" class="form-control shadow">
                                </div>
                                <div class="mb-3">
                                    <lable>Meta Keyword</lable>
                                    <textarea name="meta_keyword" class="form-control shadow" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <lable>Meta Description</lable>
                                    <textarea name="meta_description" class="form-control shadow" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                 aria-labelledby="details-tab"
                                 tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Original price</lable>
                                            <input type="text" name="original_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Selling price</lable>
                                            <input type="text" name="selling_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Quantity</lable>
                                            <input type="number" name="quantity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Trending</lable>
                                            <input type="checkbox" name="trending" style="width: 40px;height:40px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <lable>Status</lable>
                                            <input type="checkbox" name="status" style="width: 40px;height:40px">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                 aria-labelledby="image-tab"
                                 tabindex="0">
                                <div class="mp3">
                                    <lable>Upload Product Image</lable>
                                    <input type="file" name="image[]" multiple class="form-control shadow">
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel"
                                 aria-labelledby="color-tab"
                                 tabindex="0">
                                <div class="mb-3">
                                    <lable>Select Color</lable>
                                    <hr/>
                                    <div class="row">
                                        @forelse($colors as $color)
                                            <div class="p-2 border mb-3">
                                                <div class="col-md-3">
                                                    Color :<input type="checkbox" name="colors[{{$color->id}}]"
                                                                  value="{{$color->id}}">{{$color->name}}
                                                    <br>
                                                    Quantity: <input type="number" name="colorquantity[{{$color->id}}]"
                                                                     style="width:70px;border:1px solid black">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>No color Found</h1>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
