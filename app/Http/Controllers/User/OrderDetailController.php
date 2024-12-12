<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return response()->json($orderDetails);
    }

    // Menampilkan OrderDetail berdasarkan ID
    public function show($id_order_detail)
    {
        $orderDetail = OrderDetail::find($id_order_detail);

        if ($orderDetail) {
            $order = $orderDetail->order; // Mendapatkan relasi order dari order_detail

            // Cek apakah status pesanan adalah approved
            if ($order->status == 'approved') {
                return view('user.orderDetail.show', compact('orderDetail', 'order'));
            }

            return response()->json(['message' => 'Akses tidak diizinkan'], 403);
        }

        return response()->json(['message' => 'Order Detail not found'], 404);
    }
}
