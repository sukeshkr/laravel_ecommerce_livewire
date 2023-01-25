<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        $users = Order::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->orderBy('created_at','ASC')
                    ->pluck('count', 'month_name');

        $labels = $users->keys();

        $data = $users->values();

        //return view('admin.chartjs',compact('labels','data'));
        return view('admin.highchart',compact('labels','data'));
    }
}
