<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice=0;

    public function incrementCart(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();

        if($cartData) {

            if($cartData->productColor()->where('id',$cartData->product_color_id)->exists()) {

                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();

                if($productColor->quantity > $cartData->quantity) {

                    $cartData->increment('quantity');

                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Quantity updated',
                        'type'=> 'info',
                        'status' =>200,
                    ]);
                }
                else{

                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Only '.$productColor->quantity.' Quantity Available',
                        'type'=> 'info',
                        'status' =>200,
                    ]);
                }

            }
            else {

                if($cartData->product->quantity > $cartData->quantity) {

                    $cartData->increment('quantity');

                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Quantity updated',
                        'type'=> 'info',
                        'status' =>200,
                    ]);
                }
                else{

                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Only '.$cartData->product->quantity.' Quantity Available',
                        'type'=> 'info',
                        'status' =>200,
                    ]);

                }

            }
        }
        else {

            $this->dispatchBrowserEvent('message',[
                'text' => 'Cart ID is not found',
                'type'=> 'error',
                'status' =>404,
            ]);
        }
    }

    public function decrementCart(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();

        if($cartData) {

            if($cartData->productColor()->where('id',$cartData->product_color_id)->exists()) {

                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();

                if($productColor->quantity > $cartData->quantity) {

                    if($cartData->quantity > 1) {

                        $cartData->decrement('quantity');

                        $this->dispatchBrowserEvent('message',[
                            'text' => 'Quantity updated',
                            'type'=> 'info',
                            'status' =>200,
                        ]);
                    }
                }
                else{
                    $cartData->decrement('quantity');
                }
            }
            else {

                if($cartData->product->quantity > $cartData->quantity) {

                    if($cartData->quantity > 1) {

                        $cartData->decrement('quantity');

                        $this->dispatchBrowserEvent('message',[
                            'text' => 'Quantity updated',
                            'type'=> 'info',
                            'status' =>200,
                        ]);
                    }
                }
                else {

                    $cartData->decrement('quantity');
                }
            }
        }
        else {

            $this->dispatchBrowserEvent('message',[
                'text' => 'Cart ID is not found',
                'type'=> 'error',
                'status' =>404,
            ]);
        }
    }

    public function removeCartItem(int $cardId)
    {
        $cartRemoveData = Cart::where('user_id',auth()->user()->id)->where('id',$cardId)->first();

        if($cartRemoveData) {

            $cartRemoveData->delete();

            $this->dispatchBrowserEvent('message',[
                'text' => 'Removed succesfully',
                'type'=> 'success',
                'status' =>200,
            ]);

            $this->emit('CartAddedUpdated');
        }
        else {
            $this->dispatchBrowserEvent('message',[
                'text' => 'Something went wrong',
                'type'=> 'error',
                'status' =>404,
            ]);

        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id',auth()->user()->id)->get();

        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart,
        ]);
    }
}
