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
                if ($productColor->qunatity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only'.$productColor->qunatity.'Quantity available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->qunatity) {
                    $cartData->decrement('quantity');
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

    public function incrementQuantity($catid)
    {
        $cartData = Cart::query()->where('id', $catid)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->qunatity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only'.$productColor->qunatity.'Quantity available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->qunatity) {
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
