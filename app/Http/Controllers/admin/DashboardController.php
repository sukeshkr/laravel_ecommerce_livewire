<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount    = Product::count();
        $categoryCount   = Category::count();
        $brandCount      = Brand::count();
        $totalUsersCount = User::count();
        $adminCount      = User::where('role_as',1)->count();
        $userCount       = User::where('role_as',0)->count();
        $totalOrder      = Order::count();
        $todayDate       = Carbon::now()->format('d-m-Y');
        $thisMonth       = Carbon::now()->format('m');
        $thisYear       = Carbon::now()->format('Y');
        $todayOrder      = Order::whereDate('created_at',$todayDate)->count();
        $thisMonthOrder  = Order::whereMonth('created_at',$thisMonth)->count();
        $thisYearOrder  = Order::whereYear('created_at',$thisYear)->count();
        return view('admin.dashboard',compact('productCount','categoryCount', 'brandCount','totalUsersCount',
                                        'adminCount','userCount','totalOrder','todayOrder',
                                        'thisMonthOrder','thisYearOrder'));
    }
}
