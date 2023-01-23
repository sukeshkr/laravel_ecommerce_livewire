<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMailSend;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at',$todayDate)->paginate();

        $todayDate = Carbon::now()->format('Y-m-d');

        $orders = Order::when($request->date != null, function ($q) use ($request) {

            return $q->whereDate('created_at', $request->date);

            },function ($q) use ($todayDate) {

                return $q->whereDate('created_at',$todayDate);

            })

            ->when($request->status != null, function ($q) use ($request) {

                return $q->where('status_message', $request->status);

            })->paginate(10);

        return view('admin.order.index',compact('orders'));
    }
    public function orderView(int $orderId)
    {
        $order = Order::where('id',$orderId)->first();
        if($order) {

            return view('admin.order.view',compact('order'));
        }
        else {
            return redirect()->back()->with('message','Order ID not found');
        }
    }

    public function updateOrderStatus(int $orderId,Request $request)
    {
        $order = Order::where('id',$orderId)->first();

        if($order) {

            $order->update([
                'status_message' => $request->order_status,
            ]);
            return redirect()->back()->with('message','Order Status Updated Successfull');
        }
        else {
            return redirect()->back()->with('message','Order ID not found');
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.view',compact('order'));

    }

    public function downloadInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        $data = ['order'=>$order];

        $pdf = Pdf::loadView('admin.invoice.view', $data);
        return $pdf->download('invoice_'.$order->id.'.'.'pdf');

    }

    public function mailInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        try {

            Mail::to($order->email)->send(new InvoiceMailSend($order));
            return redirect()->back()->with('message','mail has sent with attached Invoice to '.$order->email);
        }
        catch(\Exception $e) {

            return redirect()->back()->with('message','Something Went wrong');
        }
    }
}
