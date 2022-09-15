<?php

namespace App\Http\Livewire\Frontend\Prodcut;

use Livewire\Component;


class View extends Component
{   public $category,$product,$prodColorSelectorQty;
    public function mount($product,$category){
        $this->category=$category;
        $this->product=$product;
    }
    public function colorSelected($colorItemId){
//       dd($colorItemId);
        $productColor = $this->product->prodcutColors()->where('id',$colorItemId)->first();
       $this->prodColorSelectorQty =$productColor->quantity;
       if($this->prodColorSelectorQty== 0){
           $this->prodColorSelectorQty = 'outOfStock';
       }
    }
    public function render()
    {
        return view('livewire.frontend.prodcut.view',[
            'product'=>$this->product,
            'category'=>$this->category
        ]);
    }
}
