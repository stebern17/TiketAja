<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data total sales per bulan
        $salesData = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $userCount = User::count();
        $eventCount = Event::count();
        $orderCount = Order::count();

        // Return view dengan data
        return view('admin.dashboard', compact('salesData', 'userCount', 'eventCount', 'orderCount'));
    }
}
