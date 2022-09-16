<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::query()->where('status', '1')->get();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request,)
    {
        $validatedData = $request->validated();
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
        return redirect(route('admin.product'))->with('message', 'Product Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product_color = $product->prodcutColors()->pluck('color_id')->toArray();
        $colors = Color::query()->whereNotIn('id', $product_color)->get();
        return view('admin.products.edit', compact('product', 'brands', 'categories', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $product)
    {
        $validatedData = $request->validated();
        $product = Category::query()->findOrFail($validatedData['category_id'])
            ->products()->where('id', $product)->first();
        if ($product) {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? "1" : "0",
                'status' => $request->status == true ? "1" : "0",
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
            if($request->colors){
                foreach ($request->colors as $key =>$color){
                    $fara=$product->prodcutColors()->updated([
                        'product_id' => $product->id,
                        'color_id'=>$color,
                        'quantity'=>$request->colorquantity[$key] ?? 0,
                    ]);

                }

            }
            return redirect('admin/product')->with('message', 'Product Updated Successfully');

        } else {
            return redirect(route('admin.product'))->with('message', 'No Such Product Id Found');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $product_id)
    {
        $product = Product::query()->findOrFail($product_id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function destroyImage(int $product)
    {
        $productImage = ProductImage::query()->findOrFail($product);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product image deleted');
    }

    public function updateProductColorQty(Request $request, $product_color_id)
    {
        $productColorData = Product::query()->findOrFail($request->prodcut_id)
            ->prodcutColors()->where('id', $product_color_id)->first();

        $productColorData->update([
            'quantity' => $request->qty,
        ]);
        return response()->json(['message' => 'Product Color Quantity updated']);
    }

    public function deleteProductColor($product_color_id)
    {
        $productColor = ProductColor::query()->findOrFail($product_color_id);
        $productColor->delete();
        return response()->json(['message' => 'Product Color Deleted']);
    }
}
