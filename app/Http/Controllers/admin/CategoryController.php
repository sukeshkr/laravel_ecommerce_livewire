<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.list');
    }
    public function categoryCreate()
    {
        return view('admin.category.create');
    }
    public function categoryPost(CategoryFormRequest $request)
    {
        $validated = $request->validated();

        $category = new Category();
        $category->name = $validated['name'];
        $category->slug = Str::slug($validated['slug']);
        $category->description = $validated['description'];
        $category->meta_keyword = $validated['meta_keyword'];
        $category->meta_title = $validated['meta_title'];
        $category->meta_description = $validated['meta_description'];
        $category->status = $request->status == true ? 1 : 0;

        if($request->hasFile('image')) {

            $fileName = $request->file('image')->hashName();
            $request->image->move(public_path('uploads/category'),$fileName);

            $category->image = $fileName;
        }

        $category->save();

        return redirect()->back()->with('message','Created Sucessfully');
    }

    public function categoryEdit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }
    public function categoryUpdate(CategoryFormRequest $request)
    {
        $validated = $request->validated();

        $validated['status'] = $request->status == true ? 1 : 0;

        if($request->hasFile('image')) {

            $fileName = $request->file('image')->hashName();
            $request->image->move(public_path('uploads/category'),$fileName);

            $validated['image'] = $fileName;
        }

        Category::where('id',$request->id)->update($validated);

        return redirect()->route('admin.category')->with('message','Updated Sucessfully');
    }
}
