<?php

namespace App\Http\Livewire\Frontend;

use App\Models\WishList as WishListModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    public function removeWishListItem(int $wishListId)
    {
        $wishList = WishListModel::where('user_id',Auth::user()->id)->where('id',$wishListId)->first()->delete();

        $this->emit('wishListAddedUpdated');

        $this->dispatchBrowserEvent('message',[
            'text' => 'This Wish list item deleted sucessfully',
            'type'=> 'info',
            'status' =>200,
        ]);


    }
    public function render()
    {
        $wishList = WishListModel::where('user_id',Auth::user()->id)->get();
        return view('livewire.frontend.wishlist',[
            'wishList'=>$wishList,
        ]);
    }
}
