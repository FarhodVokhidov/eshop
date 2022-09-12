<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status,$brand_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable'
        ];
    }
    public function resetInput(){
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }
    public function StoreBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? "1" : "0",
        ]);
        session()->flash('message','Brand added successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }
    public function closeModel()
    {
        $this->resetInput();
    }
    public function openModal(){

    }


    public function editBrand(int $brand_id){
        $this->brand_id = $brand_id;
        $brand = Brand::query()->findOrFail($this->brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;


    }
    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::query()->findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? "1" : "0",
        ]);
        session()->flash('message','Brand Updated successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }
    public function destroyBrand(){
        $brand = Brand::query()->findOrFail($this->brand_id);
        $brand->delete();
        session()->flash('message','Brand Delete Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id){
       $this->brand_id = $brand_id;
    }

    public function render()
    {
        $brands = Brand::query()->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands])
            ->extends('layouts.admin')
            ->section('content');
    }
}
