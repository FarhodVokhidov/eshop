<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function wishlistDelete(int $wishlistId){
        Wishlist::query()->where('id',$wishlistId)->where('user_id',auth()->user()->id)->delete();
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wihslist Item Removed Successfully',
            'type'=>'success',
            'status'=>200,
        ]);
    }
    public function render()
    {
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist'=>$wishlist
        ]);
    }
}
