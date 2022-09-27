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
                    <table class="table table-bordered table-striped product_datatable">
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
{{--                        <tbody>--}}
{{--                        @forelse($products as $product)--}}
{{--                            <tr>--}}
{{--                                <td>{{$product->id}}</td>--}}
{{--                                <td>--}}
{{--                                    @if($product->category)--}}
{{--                                        {{$product->category->name}}--}}
{{--                                    @else--}}
{{--                                        No Category--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>{{$product->name}}</td>--}}
{{--                                <td >--}}
{{--                                    @if($product->selling_price)--}}
{{--                                        <div class="">--}}
{{--                                            <h6>{{$product->selling_price}} <a  class="float-end nav-link text-white  border-lg rounded-circle p-2  " style="background-color: #0e4cfd">Sell</a></h6>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        {{$product->original_price}}--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>{{$product->quantity}}</td>--}}
{{--                                <td>{{$product->status == '1' ? 'Hidden':'Visible'}}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{url('admin/product/'.$product->id).'/edit'}}" class="btn btn-success">Edit</a>
{{--                                    <a href="{{url('admin/product/'.$product->id.'/delete')}}" onclick="return confirm('Are you sure,you want to delete this Data?')" class="btn btn-danger">Delete</a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <tr>--}}
{{--                                <td colspan="7">No Products Available</td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
                    </table>
{{--                    <div class="d-flex justify-content-center">--}}
{{--                        {!! $products->links() !!}--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function () {
           var table = $('.product_datatable').DataTable({
                processing: true,
               serverSide: true,
               ajax: "{{route('admin.product')}}",
               columns: [
                   {data:'id',name: 'id'},
                   {data:'category_id',name: 'category_id'},
                   {data:'name',name: 'name'},
                   {data:'original_price',name: 'original_price'},
                   {data:'quantity',name: 'quantity'},
                   {data:'status',name: 'status'},
                   {data:'action',name: 'action', orderable: false,searchable: false},
               ]
           });
       })
    </script>
@endsection
