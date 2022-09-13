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
                    <h3>Add Prodcusts
                        <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-primary float-end">Add
                            Product</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                    @if($product->category)
                                        {{$product->category->name}}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{$product->name}}</td>
                                <td class="d-flex justify-content-between">@if($product->selling_price)
                                        <div class="">
                                            <h6>{{$product->selling_price}}</h6>
                                        </div>
                                        <div>
                                               <h6 class="bg-google">Sale</h6>
                                        </div>
                                    @else
                                                                                {{$product->original_price}}
                                    @endif
                                </td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status == '1' ? 'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="{{url('admin/product/'.$product->id).'/edit'}}" class="btn btn-success">Edit</a>
                                    <a href="{{url('admin/product/'.$product->id.'/delete')}}" onclick="return confirm('Are you sure,you want to delete this Data?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Products Available</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection