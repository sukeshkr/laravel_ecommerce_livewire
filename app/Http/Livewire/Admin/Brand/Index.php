<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $brand_name, $brand_slug, $status, $brand_id, $category_id;

    public function rules()
    {
        return [
            'category_id'=>'required|integer',
            'brand_name'=>'required|string',
            'brand_slug'=>'required|string',
            'status'=>'nullable',
        ];
    }
    public function resetInput()
    {
        $this->brand_name = NULL;
        $this->brand_slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
        $this->category_id = NULL;
    }
    public function storeBrand()
    {
        $validatedData = $this->validate();

        Brand::create([
            'name' => $this->brand_name,
            'category_id' => $this->category_id,
            'slug' => Str::slug($this->brand_slug),
            'status' => $this->status ==true ? 1 : 0,
        ]);

        session()->flash('message','Created Sucessfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;

        $brand = Brand::findOrFail($brand_id);

        $this->brand_name = $brand->name;
        $this->category_id = $brand->category_id;
        $this->brand_slug = $brand->slug;
        $this->status = $brand->status;

    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->brand_name,
            'category_id' => $this->category_id,
            'slug' => Str::slug($this->brand_slug),
            'status' => $this->status ==true ? 1 : 0,
        ]);
        session()->flash('message','Updated Sucessfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function deleteBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
    }
    public function destroyBrand()
    {
        Brand::destroy($this->brand_id);
        session()->flash('message','Deleted sucessfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function render()
    {
        $categories = Category::where('status',0)->get();

        return view('livewire.admin.brand.index',[
            'brands'=>Brand::paginate(10),
            'categories'=> $categories])
            ->extends('layouts.admin')
            ->section('content');
    }
}
