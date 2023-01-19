<?php

namespace App\Http\Controllers\admin;

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
    public function index()
    {
        $datas = Product::all();
        return view('admin.product.list',compact('datas'));
    }
    public function productCreate()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.product.create',compact('categories','brands','colors'));
    }
    public function productPost(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'meta_title' => $validatedData['meta_title'],
            'meta_description' => $validatedData['meta_description'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $validatedData['trending'],
            'status' => $validatedData['status'],
        ]);

        if($request->hasFile('images')) {

            $path = 'uploads/products/';

            foreach($request->file('images') as $image) {

                $fileName = $image->hashName();
                $image->move(public_path($path),$fileName);

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image'  =>  $fileName,
                ]);
            }
        }

        if($request->colors) {
            foreach($request->colors as $key => $color) {

                $res = $product->productColors()->create([
                    'product_id'=> $product->id,
                    'color_id'=> $color,
                    'quantity'=> $request->color_quantity[$key] ?? 0,

                ]);
            }
        }

        return redirect()->back()->with('message','Created Sucessfully');
    }

    public function productEdit(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        $brands = Brand::all();
        $product_colors = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id',$product_colors)->get();
        return view('admin.product.edit',compact('product','categories','brands','colors','product_colors'));

    }
    public function productUpdate(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category'])
                    ->products()->where('id',$product_id)->first();

        if($product) {

            $product->update([
                'category_id' => $validatedData['category'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'meta_title' => $validatedData['meta_title'],
                'meta_description' => $validatedData['meta_description'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $validatedData['trending'],
                'status' => $validatedData['status'],
            ]);

            if($request->hasFile('images')) {

                $path = 'uploads/products/';

                foreach($request->file('images') as $image) {

                    $fileName = $image->hashName();
                    $image->move(public_path($path),$fileName);

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image'  =>  $fileName,
                    ]);
                }
            }

            if($request->colors) {
                foreach($request->colors as $key => $color) {

                    $res = $product->productColors()->create([
                        'product_id'=> $product->id,
                        'color_id'=> $color,
                        'quantity'=> $request->color_quantity[$key] ?? 0,

                    ]);
                }
            }

            return redirect()->back()->with('message','Sucessfully Updated');
        }
        else {
            return redirect()->back()->with('message','No such product id');
        }
    }

    public function productImageDelete(int $image_id)
    {

        $pimage = ProductImage::findOrFail($image_id);

        if(File::exists('uploads/products/'.$pimage->image)) {

            File::delete('uploads/products/'.$pimage->image);
        }

        $pimage->delete();

        return redirect()->back()->with('message','Product image deleted sucessfully');
    }

    public function productDelete(int $pid)
    {
        $product = Product::findOrFail($pid);

        if($product->productImages) {

            foreach ($product->productImages as $imageName) {

                if(File::exists('uploads/products/'.$imageName->image)) {

                    File::delete('uploads/products/'.$imageName->image);
                }
            }
        }

        $product->delete();

        return redirect()->back()->with('message','Product deleted with images');
    }

    public function productColorUpdate(Request $request)
    {
        if($request->ajax()) {

            $productColorData = Product::findOrFail($request->prod_id)
                                ->productColors()
                                ->where('id',$request->prod_color_id)->first();

            $productColorData->update([
                'quantity' => $request->qty,
            ]);

            return response()->json([
                'message'=> 'Product Color quantity updated',
            ]);
        }
    }

    public function productColorDelete(Request $request)
    {
        if($request->ajax()) {

            ProductColor::findOrFail($request->prod_color_id)->delete();
            return response()->json([
                'message'=> 'Product Color Deleted Sucessfully',
            ]);
        }
    }

}
