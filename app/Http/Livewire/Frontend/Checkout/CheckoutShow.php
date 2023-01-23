<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $fullname, $email, $phone, $pincode, $address, $paymentMode =NULL, $paymentID=NULL;

    protected $listeners = [
        'validationForAll',
        'transationEmit' => 'paidOnlineOrder'];

    public function validationForAll()
    {
        $this->validate();
    }

    public function paidOnlineOrder($value)
    {
        $this->paymentID = $value;

        $this->paymentMode = 'pay by paypal';

        $codOrder = $this->placeOrder();

        if($codOrder) {

            Cart::where('user_id',auth()->user()->id)->delete();

            $this->dispatchBrowserEvent('message',[

                'text' => 'Order successfully Placed',
                'type' => 'success',
                'status' => 200,
            ]);

            session()->flash('message','Order Placed Sucessfully');

            return redirect()->route('thank.you');

        }
        else {

            $this->dispatchBrowserEvent('message',[

                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 501,
            ]);

        }



    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:120',
            'email' => 'required|email',
            'phone' => 'required|string|max:10|min:10',
            'pincode' => 'required|string|max:6',
            'address' => 'required|string|max:200',
        ];
    }
    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
        'user_id' => auth()->user()->id,
        'tracking_no'=> 'suk_'.Str::random(10),
        'fullname' => $this->fullname,
        'email' => $this->email,
        'phone' => $this->phone,
        'pin' => $this->pincode,
        'address' => $this->address,
        'status_message' => 'In Progress',
        'payment_mode' => $this->paymentMode,
        'payment_id' => $this->paymentID,
        ]);

        foreach($this->carts as $cartItem) {

            $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'product_color_id' => $cartItem->product_color_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->selling_price,
            ]);
        }

        if($cartItem->product_color_id != NULL) {

            $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
        }
        else {

            $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);

        }

        return $order;
    }
    public function cashOnDelivery()
    {
        $this->paymentMode = 'Cash On Delivery';
        $codOrder = $this->placeOrder();

        if($codOrder) {

            Cart::where('user_id',auth()->user()->id)->delete();

            try {
                $order = Order::findOrFail($codOrder->id);
                Mail::to($codOrder->email)->send(new PlaceOrderMail($codOrder));

                //mail sent sucessfully
            }
            catch(\Exception $e) {
                //something went wrong
            }

            $this->dispatchBrowserEvent('message',[

                'text' => 'Order successfully Placed',
                'type' => 'success',
                'status' => 200,
            ]);

            session()->flash('message','Order Placed Sucessfully');

            return redirect()->route('thank.you');

        }
        else {

            $this->dispatchBrowserEvent('message',[

                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 501,
            ]);

        }

    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;

        $this->carts = Cart::where('user_id',auth()->user()->id)->get();

        foreach($this->carts as $cartItem) {

            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;

    }
    public function render()
    {
        $this->totalProductAmount = $this->totalProductAmount();

        $this->fullname = auth()->user()->name;
        $this->email    = auth()->user()->email;

        $this->phone    = auth()->user()->userDetail->phone;
        $this->pincode    = auth()->user()->userDetail->pin;
        $this->address    = auth()->user()->userDetail->address;

        return view('livewire.frontend.checkout.checkout-show',[

            'totalProductAmount' => $this->totalProductAmount,
        ]);
    }
}
