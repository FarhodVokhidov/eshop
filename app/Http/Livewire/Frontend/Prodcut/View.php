<?php

namespace App\Http\Livewire\Frontend\Prodcut;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class View extends Component
{
    public $category, $product, $prodColorSelectorQty;

    public function mount($product, $category)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function colorSelected($colorItemId)
    {
//       dd($colorItemId);
        $productColor = $this->product->prodcutColors()->where('id', $colorItemId)->first();
        $this->prodColorSelectorQty = $productColor->quantity;
        if ($this->prodColorSelectorQty == 0) {
            $this->prodColorSelectorQty = 'outOfStock';
        }
    }

    public function addWishlist($productId)
    {
        if(Auth::check()){
            if(Wishlist::query()->where('user_id',\auth()->user()->id)->where('product_id',$productId)->exists()){
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type'=>'success',
                    'status'=>200
                ]);
                return false;
            }
            else{
                Wishlist::create([
                    'user_id'=> \auth()->user()->id,
                    'product_id'=> $productId,
                ]);
                session()->flash('message', 'Wishlist Added successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added successfully',
                    'type'=>'success',
                    'status'=>200
                ]);
            }

        }
        else{
            session()->flash('message', 'Please Login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to continue',
                'type'=>'warning',
                'status'=>401
                ]);
            return false;
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
