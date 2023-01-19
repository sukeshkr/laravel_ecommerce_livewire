<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.list',compact('sliders'));
    }
    public function sliderCreate()
    {
        return view('admin.slider.create');
    }
    public function sliderPost(SliderFormRequest $request)
    {
        $validationData = $request->validated();

        if($request->hasFile('image')) {

            $fileName = $request->file('image')->hashName();
            $request->image->move(public_path('uploads/slider'),$fileName);

            $validationData['image'] = $fileName;
        }

        $validationData['status'] = $request->status == true ? 1 : 0;

        Slider::create([
            'title'=> $validationData['title'],
            'description'=> $validationData['description'],
            'image'=> $validationData['image'],
            'status'=> $validationData['status'],
        ]);

        return redirect()->back()->with('message','Created sucessfully');
    }
    public function sliderEdit(int $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function sliderUpdate(SliderFormRequest $request,Slider $slider)
    {
        $validationData = $request->validated();

        if($request->hasFile('image')) {

            $destination = 'uploads/slider/'.$slider->image;

            if(File::exists($destination)) {

                File::delete($destination);
            }

            $fileName = $request->file('image')->hashName();
            $request->image->move(public_path('uploads/slider'),$fileName);

            $validationData['image'] = $fileName;
        }

        $validationData['status'] = $request->status == true ? 1 : 0;

        Slider::where('id',$slider->id)->update([
            'title'=> $validationData['title'],
            'description'=> $validationData['description'],
            'image'=> $validationData['image'] ?? $slider->image,
            'status'=> $validationData['status'],
        ]);

        return redirect()->back()->with('message','Updated sucessfully');

    }

    public function sliderDelete(Slider $slider)
    {
        if($slider->count() > 0) {

            $destination = 'uploads/slider/'.$slider->image;

            if(File::exists($destination)) {

                File::delete($destination);
            }
            $slider->delete();
        }

        return redirect()->back()->with('message','Deleted sucessfully');
    }
}
