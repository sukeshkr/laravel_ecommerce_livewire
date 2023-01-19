<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category = Category::destroy($this->category_id);
        session()->flash('message','Category Deleted');
        $this->dispatchBrowserEvent('close-modal');
        // $imagePath = 'uploads/category/'.$category->image;
        // if(File::exists($imagePath)) {
        //     File::
        // }
    }

    public function render()
    {
        return view('livewire.admin.category.index', [
            'categories' => Category::paginate(5),
        ]);
    }
}
