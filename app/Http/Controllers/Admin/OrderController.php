<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
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

        // Update status order
        $order->status = $request->status;
        $order->save();

        // Jika status diubah menjadi approved, buat OrderDetail baru
        if ($order->status == 'approved') {
            $this->createOrderDetail($order);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Status transaksi berhasil diperbarui!');
    }

    // Fungsi untuk membuat OrderDetail baru
    private function createOrderDetail(Order $order)
    {
        // Ambil data yang diperlukan, seperti id_ticket, qr_code, dll.
        $ticket = $order->ticket; // Ambil data tiket dari order
        $qr_code = 'some_unique_code_' . uniqid(); // Bisa disesuaikan sesuai kebutuhan

        // Buat OrderDetail baru
        OrderDetail::create([
            'id_order' => $order->id_order,
            'id_ticket' => $ticket->id_ticket, // Menyertakan ID tiket
            'qr_code' => $qr_code, // Menyertakan QR Code
        ]);
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
