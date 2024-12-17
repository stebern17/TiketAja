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
            $order = $orderDetail->order; // Ensure the relationship is correctly defined

            if ($order->status === 'approved') {
                // Path QR Code in storage
                $qrCodePath = asset('storage/' . $orderDetail->qr_code);

                return view('user.orderDetail.show', compact('orderDetail', 'order', 'qrCodePath'));
            }

            return response()->json(['message' => 'Access denied'], 403);
        }

        return response()->json(['message' => 'Order Detail not found'], 404);
    }
}
