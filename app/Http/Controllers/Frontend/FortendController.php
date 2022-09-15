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

            return view('frontend.collection.products.index',compact('category'));
        }else{
            return redirect()->back();
        }
    }
    public function productView(string $category_slug, string $product_slug){
        $category = Category::query()->where('slug',$category_slug)->first();

        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status','1')->first();
            if ($product){
                return view('frontend.collection.products.view',compact('product','category'));
            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }
}
