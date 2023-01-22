<?php

namespace App\Http\Livewire\Frontend;

use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishListCount extends Component
{
    public $wishListCount;

    protected $listeners = ['wishListAddedUpdated' => 'checkWishListCount'];

    public function checkWishListCount()
    {
        if(Auth::check()) {

            return $this->wishListCount = WishList::where('user_id',auth()->user()->id)->count();
        }

        return $this->wishListCount = 0;
    }

    public function render()
    {
        $this->checkWishListCount();

        return view('livewire.frontend.whish-list-count',[
            'wishListCount' => $this->wishListCount,
        ]);
    }
}
