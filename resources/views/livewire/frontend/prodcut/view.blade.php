<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3 carousel slide" id="carouselExampleCaptions" data-bs-ride="false">
                    <div class="bg-white border">
                        <div class="carousel-inner">
                            @foreach($product->productImages as $key=>$slider)
                                <div class="carousel-item {{$key == 0 ? 'active':''}}">
                                    <img src="{{asset($slider->image)}}" style="height: 400px" class="d-block w-100"
                                         alt="...">
                                    <div class="carousel-caption d-none d-md-block">

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}

                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{$product->category->name}} / {{$product->name}}
                        </p>
                        <div>
                            <span class="selling-price">{{$product->selling_price}} </span>
                            <span class="original-price">{{$product->original_price}} </span>
                        </div>
                        <div>
                            @if($product->prodcutColors->count()>0)
                                @if($product->prodcutColors)
                                    @foreach($product->prodcutColors as $colorItem)
                                        {{--                                    <input type="radio" name="colorSelection" value="{{$colorItem->id}}" />{{$colorItem->color->name}}--}}
                                        <lable class="colorSelectionLabel text-warning"
                                               style="background-color: {{$colorItem->color->code}}"
                                               wire:click="colorSelected({{$colorItem->id}})">
                                            {{$colorItem->color->name}}
                                        </lable>
                                        {{--                                    <div class="d-flex">--}}
                                        {{--                                       <div style="width: 40px; height: 40px; background-color: {{$colorItem->color->name}}"></div>--}}
                                        {{--                                    </div>--}}
                                    @endforeach
                                @endif
                                @if($this->prodColorSelectorQty == 'outOfStock' )
                                    <lable class="btn py-1 mt-2 text-white bg-danger">Out of Stock</lable>
                                @elseif($this->prodColorSelectorQty > 0 )
                                    <lable class="btn py-1 mt-2 text-white bg-success">In Stock</lable>
                                @endif
                            @else
                                @if($product->quantity)
                                    <label class="btn py-1 text-white mt-2 bg-success">In Stock</label>
                                @else
                                    <label class="btn py-1 text-white mt-2 bg-danger">Out of Stock</label>
                                @endif
                            @endif


                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" value="{{$this->quantityCount}}" readonly wire:model="quantityCount"
                                       class="input-quantity"/>
                                <span class="btn btn1" wire:click="icrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                            <button type="button" wire:click="addWishlist({{$product->id}})" class="btn btn1">
                                <span wire:loading.remove wire:target="addWishlist">
                                <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addWishlist">
                                    Adding...
                                </span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{$product->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <section class="rounded-b-lg mt-4">
                    <form method="POST" action="{{route('comment',$product->id)}}">
                        @csrf

                        <textarea name="text" class="w-100 form-control "
                                  placeholder="Ваш комментарий..." spellcheck="false"></textarea>
                        @error('text')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <button type="submit"
                                class="btn btn-success">
                            Написать
                        </button>
                    </form>

                    <div id="task-comments" class="pt-4">
                        <h1>Комментария</h1>
                        @foreach($product->comments as $comment)
                            <div
                                class="bg-white rounded-lg p-3  flex flex-col justify-center items-center md:items-start shadow-lg mb-4">
                                <div class="flex flex-row justify-center mr-2">
                                    <h3 class="text-purple-600 font-semibold text-lg">{{$comment->user->name}}</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p style="width: 90%"
                                           class="text-gray-600 text-lg md:text-left ">{{$comment->text}}</p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        {{$comment->created_at}}
                                    </div>

                                </div>

                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
