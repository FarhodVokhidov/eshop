<?php

namespace App\Http\Livewire\Frontend\Prodcut;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class View extends Component
{
    public $category, $product, $prodColorSelectorQty, $quantityCount = 1, $product_id, $productColorId;

    public function mount($product, $category)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function colorSelected($colorItemId)
    {
//       dd($colorItemId);
        $this->productColorId = $colorItemId;
        $productColor = $this->product->prodcutColors()->where('id', $colorItemId)->first();
        $this->prodColorSelectorQty = $productColor->quantity;
        if ($this->prodColorSelectorQty == 0) {
            $this->prodColorSelectorQty = 'outOfStock';
        }
    }

    public function addWishlist($productId)
    {
        if (Auth::check()) {
            if (Wishlist::query()->where('user_id', \auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'success',
                    'status' => 200
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => \auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist Added successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }

        } else {
            session()->flash('message', 'Please Login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to continue',
                'type' => 'warning',
                'status' => 401
            ]);
            return false;
        }


    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function icrementQuantity()
    {
        if ($this->quantityCount < 10) {

            $this->quantityCount++;
        }

    }

    public function addToCart($product_id)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $product_id)->where('status', '1')->exists()) {
                if ($this->product->prodcutColors()->count() > 1) {
                    if ($this->prodColorSelectorQty != NULL)
                    {
                        if (Cart::query()->where('user_id', \auth()->user()->id)->where('product_id', $product_id)->where('product_color_id',$this->productColorId)->exists())
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Already Added',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        } else {
                            $productColor = $this->product->prodcutColors()->where('id', $this->productColorId)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity >= $this->quantityCount) {
                                    Cart::query()->create([
                                        'user_id' => \auth()->user()->id,
                                        'product_id' => $product_id,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount
                                    ]);
                                    $this->emit('CartAddedUpdated');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product Added to Cart',
                                        'type' => 'success',
                                        'status' => 200
                                    ]);
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only ' . $productColor->quantity . ' quantity colors Available',
                                        'type' => 'warning',
                                        'status' => 401
                                    ]);
                                }
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Out of Stock',
                                    'type' => 'warning',
                                    'status' => 401
                                ]);
                            }
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select Your Product Color',
                            'type' => 'info',
                            'status' => 401
                        ]);
                    }
                } else {
                    if (Cart::query()->where('user_id', \auth()->user()->id)->where('product_id', $product_id)->exists()) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Already Added',
                            'type' => 'warning',
                            'status' => 401
                        ]);
                    } else {
                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity > $this->quantityCount) {
                                Cart::query()->create([
                                    'user_id' => \auth()->user()->id,
                                    'product_id' => $product_id,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->emit('CartAddedUpdated');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Added to Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only ' . $this->product->quantity . ' quantity Available',
                                    'type' => 'warning',
                                    'status' => 401
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out of Stock',
                                'type' => 'warning',
                                'status' => 401
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Does not exists',
                    'type' => 'info',
                    'status' => 401
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to add to cart',
                'type' => 'warning',
                'status' => 401
            ]);
        }

    }

    public function render()
    {
        return view('livewire.frontend.prodcut.view', [
            'product' => $this->product,
            'category' => $this->category
        ]);
    }
}
