<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse($cart as $cartItem)
                            @if($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{url('collection/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug)}}">
                                                <label class="product-name">
                                                    @if($cartItem->product->productImages)
                                                        <img src="{{asset($cartItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="">
                                                    @endif
                                                    {{$cartItem->product->name}}
                                                    @if($cartItem->productColor)
                                                        <br>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div>With color :</div> <div class="text-white text-center" style="width: 50px; height: 30px;background-color: {{$cartItem->productColor->color->name}}">{{$cartItem->productColor->color->name}}</div>
                                                    </div>
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            @if($cartItem->product->selling_price > 0)
                                            <label class="price">{{$cartItem->product->selling_price}} </label>
                                            @else
                                                <label class="price">{{$cartItem->product->original_price}} </label>
                                            @endif
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disabled"  wire:click="decrementQuantity({{$cartItem->id}})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{$cartItem->quantity}}" class="input-quantity"/>
                                                    <button type="button" wire:loading.attr="disabled" wire:click="incrementQuantity({{$cartItem->id}})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            @if($cartItem->product->selling_price > 0)
                                                <label class="price">{{$cartItem->product->selling_price* $cartItem->quantity}} </label>
                                            @else
                                                <label class="price">{{$cartItem->product->original_price*$cartItem->quantity}} </label>
                                            @endif
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <a href="" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div>
                                No cart Items available
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
