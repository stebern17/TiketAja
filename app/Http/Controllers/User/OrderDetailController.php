<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\TicketValidation;

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

            // Fetch the validation status of the ticket from the ticket_validation table
            $ticketValidation = TicketValidation::where('id_order_detail', $orderDetail->id_order_detail)
                ->first();

            $isTicketValid = $ticketValidation ? $ticketValidation->is_valid : false;

            // Path QR Code in storage
            $qrCodePath = asset('storage/' . $orderDetail->qr_code);

            return view('user.orderDetail.show', compact('orderDetail', 'order', 'qrCodePath', 'isTicketValid'));
        }

        return response()->json(['message' => 'Order Detail not found'], 404);
    }
}
