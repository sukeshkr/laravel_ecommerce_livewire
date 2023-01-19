<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',0)->get();
        return view('frontend.index',compact('sliders'));
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

            $products = $category->products()->get();

            return  view('frontend.collections.products.index',compact('products','category'));

        }
        else {
            return redirect()->back();
        }
    }

    public function slugProduct($id,$id1)
    {
        return "hi";
    }
}
