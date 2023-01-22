<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',0)->get();
        $trendingProduct = Product::where('trending',1)->latest()->take(15)->get();
        return view('frontend.index',compact('sliders','trendingProduct'));
    }
    public function newArrivals()
    {
        $newArrivalProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival',compact('newArrivalProducts'));
    }
    public function categories()
    {
        $categories = Category::where('status',0)->get();
        return view('frontend.collections.categories.index',compact('categories'));
    }
    public function categoryProduct($cat_slug)
    {

        $category =  Category::where('slug',$cat_slug)->first();

        if($category) {

            // $products = $category->products()->get();
            // return  view('frontend.collections.products.index',compact('products','category'));

            return  view('frontend.collections.products.index',compact('category'));

        }
        else {
            return redirect()->back();
        }
    }

    public function viewProduct(string $category_slug, string $product_slug)
    {
        $category =  Category::where('slug',$category_slug)->first();

        if($category) {

            $product =  $category->products()->where('slug',$product_slug)->first();

           // return $product;

            if($product) {

            return  view('frontend.collections.products.view',compact('category','product'));
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }
    }

    public function thankYou()
    {
        return  view('frontend.thankyou');

    }
}
