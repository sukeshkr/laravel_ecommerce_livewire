<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.color.list',compact('colors'));
    }
    public function colorCreate()
    {
        return view('admin.color.create');
    }
    public function colorPost(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        $color = Color::create($validatedData);
        return redirect()->back()->with('message','Created Sucessfully');
    }
    public function colorEdit(Color $color)
    {
        return view('admin.color.edit',compact('color'));

    }
    public function colorUpdate(ColorFormRequest $request,int $color_id)
    {
        $validatedData = $request->validated();

        Color::find($color_id)->update($validatedData);

        return redirect()->back()->with('message','Updated Sucessfully');

    }
    public function colorDelete(int $color_id)
    {
        Color::destroy($color_id);

        return redirect()->route('colors')->with('message','Deleted Sucessfully');

    }

}
