<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Http\Controllers\Frontend\CartController;
use App\Models\Cart;
use Livewire\Component;

class Cartshow extends Component
{
    public $cart;

    public function decrementQuantity($catid)
    {
        $cartData = Cart::query()->where('id', $catid)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($cartData->quantity<=0){
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity only increment',
                        'type' => 'success',
                        'status' => 200
                    ]);
                    $cartData->increment('quantity',0);
                }
                elseif ($productColor->quantity >= $cartData->quantity && $cartData->quantity>=0) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only'.$productColor->quantity.'Quantity available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
            else {
                if ($cartData->quantity<=0){
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity only increment',
                        'type' => 'error',
                        'status' => 200
                    ]);
                    $cartData->increment('quantity',0);
                }
                elseif ($cartData->product->quantity >= $cartData->quantity) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$cartData->product->quantity.' Quantity available',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 200
            ]);
        }
    }

    public function incrementQuantity($catid)
    {
        $cartData = Cart::query()->where('id', $catid)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$productColor->quantity.' Quantity available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only'.$cartData->product->quantity.'Quantity available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 200
            ]);
        }

    }
    public function deleteCart($cartId){
       $cartRemove = Cart::query()->where('id',$cartId)->where('user_id',auth()->user()->id)->first();
       if ($cartRemove){
           $cartRemove->delete();
           $this->dispatchBrowserEvent('message', [
               'text' => 'Product Delete in Cart',
               'type' => 'success',
               'status' => 200
           ]);
       }
       else{
           $this->dispatchBrowserEvent('message', [
               'text' => 'Something Went Wrong',
               'type' => 'error',
               'status' => 500
           ]);
       }
    }

    public function render()
    {
        $this->cart = Cart::query()->where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cartshow', [
            'cart' => $this->cart,
        ]);
    }
}
