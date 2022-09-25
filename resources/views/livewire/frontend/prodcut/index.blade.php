<div>
    <div class="row">
        <div class="col-md-2">
            @if($category->brand)
                <div class="card">
                    <div class="card-header">
                        <h4>Brands</h4>
                    </div>
                    <div class="card-body">
                        @foreach($category->brand as $cat)
                            <div class="d-block">
                                <input type="checkbox" wire:model="brandInputs" value="{{$cat->name}}"/>{{$cat->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Price</h4>
                </div>
                <div class="card-body">
                    <div class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"/>High to Low
                    </div>
                    <div class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"/>Low to High
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-10">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-2">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if($product->quantity>0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif
                                @if($product->productImages->count()>0)
                                    <a href="{{url('/collection/'.$category->slug.'/'.$product->slug)}}">
                                        <div class="w-100">
                                            <img src="{{asset($product->productImages[0]->image)}}" width="400" height="600"
                                                 class="img-thumbnail" alt="Laptop">
                                        </div>

                                    </a>
                                @endif

                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{$product->brand}}</p>
                                <h5 class="product-name">
                                    <a href="">
                                        {{$product->name}}
                                    </a>
                                </h5>
                                <div>
                                    @if($product->selling_price==0)
                                        <span class="selling-price">{{$product->original_price}}</span>
                                    @else
                                    <span class="selling-price">{{$product->selling_price}}</span>
                                        <span class="original-price">{{$product->original_price}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>No brand Product</h2>
                @endforelse
            </div>
        </div>

    </div>


</div>
