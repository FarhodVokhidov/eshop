<?php

namespace App\Http\Livewire\Frontend\Prodcut;

use Livewire\Component;

class Index extends Component
{
    public $products, $category;
    public function mount($products,$category){
        $this->products =$products;
        $this->category = $category;

    }
    public function render()
    {
        return view('livewire.frontend.prodcut.index');
    }
}
