<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $porductColorSelectedQty, $quantityCount = 1, $ProductColorId;

    public function incrementQuantity()
    {
        if($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1) {
            $this->quantityCount--;
        }

    }

    public function addToWishList($ProductId)
    {
        if(Auth::check()) {

            if(WishList::where('user_id',Auth::user()->id)->where('product_id',$ProductId)->exists()) {

                session()->flash('message','This item already added to Wish List');

                $this->dispatchBrowserEvent('message', [
                    'text' => 'This item already added to Wish List',
                    'type' => 'info',
                    'status' => 409,
                ]);
                return false;
            }
            else {
                WishList::create([
                    'product_id' => $ProductId,
                    'user_id' => Auth::user()->id,
                ]);

                $this->emit('wishListAddedUpdated');

                session()->flash('message','Added To Wish List');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Added To Wish List',
                    'type' => 'success',
                    'status' => 20,
                ]);
            }
       }
       else {
        session()->flash('message','You have to Login first');
        $this->dispatchBrowserEvent('message', [
            'text' => 'You have to Login first',
            'type' => 'warning',
            'status' => 401,
        ]);

        return false;
       }
    }

    public function addToCart(int $ProductId)
    {
        if(Auth::check()) {

            if ($this->product->where('id',$ProductId)->exists()) {

                if($this->product->productColors()->count() >= 1) { //check whether product have color quantity or not

                    if($this->porductColorSelectedQty != NULL) {

                        if(Cart::where('user_id',auth()->user()->id)
                                ->where('product_id',$ProductId)
                                ->where('product_color_id',$this->ProductColorId)
                                ->exists()) {

                            $this->dispatchBrowserEvent('message',[
                            'text' => 'This product already added to your cart',
                            'type' => 'warning',
                            'status' => 401,
                            ]);
                        }
                        else {

                            $productColor = $this->product->productColors()->where('id',$this->ProductColorId)->first();

                            if($productColor->quantity > 0) {

                                if ($productColor->quantity >= $this->quantityCount) {
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id'=> $ProductId,
                                        'product_color_id' => $this->ProductColorId,
                                        'quantity' => $this->quantityCount,
                                    ]);

                                    $this->emit('CartAddedUpdated');

                                    $this->dispatchBrowserEvent('message',[
                                    'text' => 'Sucessfully added to cart',
                                    'type' => 'success',
                                    'status' => 200,
                                    ]);
                                }
                                else {
                                    $this->dispatchBrowserEvent('message',[
                                    'text' => 'Only '.$productColor->quantity.' Quantity Available',
                                    'type' => 'info',
                                    'status' => 401,
                                    ]);
                                }
                            }

                            else {
                                $this->dispatchBrowserEvent('message',[
                                'text' => 'Out of stock',
                                'type' => 'warning',
                                'status' => 404,
                                ]);
                            }

                        }
                    }
                    else {

                        $this->dispatchBrowserEvent('message',[
                        'text' => 'Please select your color first',
                        'type' => 'info',
                        'status' => 404,
                        ]);
                    }
                }
                else {

                    if(Cart::where('user_id',auth()->user()->id)->where('product_id',$ProductId)->exists()) {

                        $this->dispatchBrowserEvent('message',[
                        'text' => 'This product already added to your cart',
                        'type' => 'warning',
                        'status' => 401,
                        ]);
                    }
                    else {

                        if ($this->product->quantity > 0) {

                            if ($this->product->quantity >= $this->quantityCount) {

                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id'=> $ProductId,
                                    'quantity' => $this->quantityCount,
                                ]);

                                $this->emit('CartAddedUpdated');

                                $this->dispatchBrowserEvent('message',[
                                'text' => 'Sucessfully added to cart',
                                'type' => 'success',
                                'status' => 200,
                                ]);
                            }
                            else {

                                $this->dispatchBrowserEvent('message',[
                                'text' => 'Only '.$this->product->quantity.' Quantity Available',
                                'type' => 'info',
                                'status' => 401,
                                ]);
                            }
                        }
                        else {

                            $this->dispatchBrowserEvent('message',[
                            'text' => 'Product Out of stock',
                            'type' => 'info',
                            'status' => 401,
                            ]);

                        }
                    }
                }
            }
            else {

                $this->dispatchBrowserEvent('message',[
                'text' => 'Product does not exists',
                'type' => 'warning',
                'status' => 404,
                ]);
            }
        }
        else {

            $this->dispatchBrowserEvent('message',[
            'text' => 'You have to Login First',
            'type' => 'info',
            'status' => 401,
            ]);
        }
    }

    public function colorSelected($ProductColorId)
    {

        $this->ProductColorId = $ProductColorId;

        $productColor = $this->product->productColors()->where('id',$ProductColorId)->first();

        $this->porductColorSelectedQty = $productColor->quantity;

        if($this->porductColorSelectedQty == 0) {

            $this->porductColorSelectedQty = 'outOfStock';
        }

    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'product' => $this->product
        ]);
    }
}
