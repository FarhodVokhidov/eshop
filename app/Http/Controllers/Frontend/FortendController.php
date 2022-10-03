<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentForm;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use willvincent\Rateable\Rating;

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
        $rate = Rating::query()->where('id',);
        dd($category->products);
        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status','1')->first();
            if ($product){
                return view('frontend.collection.products.view',compact('product','category','rate'));
            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }
    public function comment(CommentForm $request,$id){
        $product = Product::query()->findOrFail($id);
        $validatetData = $request->validated();
        $product->comments()->create($validatetData);
        return redirect(route('productview',[$product->category->slug,$product->slug]));
    }

}
