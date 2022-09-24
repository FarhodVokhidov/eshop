<?php

namespace App\services\Product\Post;

use App\Models\Category;
use Illuminate\Support\Str;

class PostService
{
    public function Productstore($validatedData,$request){
        $category = Category::query()->findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? "0" : "1",
            'status' => $request->status == true ? "0" : "1",
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);
        if ($request->hasFile('image')) {
            $uploadPath = 'upload/products/';

            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,

                ]);
            }
        }
        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->prodcutColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0,
                ]);
            }
        }
    }
//    public function Productupdated($validatedData,$request,$product_id){
//        $product = Category::query()->findOrFail($validatedData['category_id'])
//            ->products()->where('id', $product_id)->first();
//        if ($product) {
//            $product->update([
//                'category_id' => $validatedData['category_id'],
//                'name' => $validatedData['name'],
//                'slug' => Str::slug($validatedData['slug']),
//                'brand' => $validatedData['brand'],
//                'small_description' => $validatedData['small_description'],
//                'description' => $validatedData['description'],
//                'original_price' => $validatedData['original_price'],
//                'selling_price' => $validatedData['selling_price'],
//                'quantity' => $validatedData['quantity'],
//                'trending' => $request->trending == true ? "1" : "0",
//                'status' => $request->status == true ? "1" : "0",
//                'meta_title' => $validatedData['meta_title'],
//                'meta_keyword' => $validatedData['meta_keyword'],
//                'meta_description' => $validatedData['meta_description'],
//            ]);
//            if ($request->hasFile('image')) {
//                $uploadPath = 'upload/products/';
//                $i = 0;
//                foreach ($request->file('image') as $imageFile) {
//                    $extention = $imageFile->getClientOriginalExtension();
//                    $filename = time() . $i++ . '.' . $extention;
//                    $imageFile->move($uploadPath, $filename);
//                    $finalImagePathName = $uploadPath . $filename;
//                    $product->productImages()->create([
//                        'product_id' => $product->id,
//                        'image' => $finalImagePathName,
//                    ]);
//                }
//            }
//            if($request->colors){
//                foreach ($request->colors as $key =>$color){
//                    $fara=$product->prodcutColors()->update([
//                        'product_id' => $product->id,
//                        'color_id'=>$color,
//                        'quantity'=>$request->colorquantity[$key] ?? 0,
//                    ]);
//
//                }
//
//            }
//            return 1;
//
//        } else {
//            return 0;
//        }
//    }

}
