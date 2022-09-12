<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $cat_id;
    public function deleteCategory($category_name)
    {
        $this->cat_id = $category_name;
    }
    public function destroyCategory()
    {
        $category = Category::query()->first();
        $path = 'upload/category'.$category->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $category->delete();
        session()->flash('message','Category Deleted');
        $this->dispatchBrowserEvent('close-modal');

    }

    public function render()
    {
        $categories = Category::query()->orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.category.index',['categories'=>$categories]);
    }


}
