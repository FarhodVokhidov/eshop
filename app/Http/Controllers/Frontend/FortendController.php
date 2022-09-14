<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FortendController extends Controller
{
    public function index(){
        $sliders=Slider::where('status','1')->get();
        return view('frontend.index',compact('sliders'));
    }
    public function categories(){
        $categories = Category::query()->where('status','1')->get();
        return view('frontend.category',compact('categories'));
    }
    public function product_by_category($category_slug){
        $category = Category::query()->where('slug',$category_slug)->first();
        if($category){
            $products = $category->products()->get();
            return view('frontend.collection.products.index',compact('products','category'));
        }else{
            return redirect()->back();
        }
    }
}
