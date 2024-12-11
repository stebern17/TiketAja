<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        // Mengambil semua order dengan relasi ke ticket
        $orders = Order::with('ticket', 'event', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Validasi dan update status
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status transaksi berhasil diperbarui!');
    }

    public function showPaymentProof(Order $order)
    {
        // Mengambil path lengkap gambar
        $imagePath = storage_path('app/public/' . $order->payment_proof);

        // Pastikan file gambar ada
        if (!file_exists($imagePath)) {
            abort(404, 'Gambar tidak ditemukan');
        }

        return response()->file($imagePath);
    }
}
