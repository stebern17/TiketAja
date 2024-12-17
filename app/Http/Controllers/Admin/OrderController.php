<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;



class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['ticket.event', 'user'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id_order)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $order = Order::with('ticket')->findOrFail($id_order);

        if (!$order->ticket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan untuk order ini.');
        }

        if ($order->status !== 'pending' && $request->status === 'approved') {
            return redirect()->back()->with('error', 'Order tidak dapat diubah lagi.');
        }

        if ($request->status === 'approved' && $order->status === 'pending') {
            $ticket = $order->ticket;
            if ($ticket->quantity >= $order->quantity) {
                $ticket->quantity -= $order->quantity;
                $ticket->save();

                $this->createOrderDetail($order);
            } else {
                return redirect()->back()->with('error', 'Stok tiket tidak mencukupi.');
            }
        }

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    private function createOrderDetail(Order $order)
    {
        $ticket = $order->ticket;

        // Format QR Code: "id_order_detail|id_order|id_ticket"
        $qr_code_content = $order->id_order_detail . '|' . $order->id_order . '|' . $ticket->id_ticket;

        // Generate QR Code using Endroid
        $qrCode = new QrCode($qr_code_content);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Simpan QR Code ke storage
        $qr_code_filename = 'qrcodes/' . uniqid() . '.png';
        Storage::disk('public')->put($qr_code_filename, $result->getString());

        // Simpan ke database (OrderDetail akan menyimpan QR Code)
        OrderDetail::create([
            'id_order' => $order->id_order,
            'id_ticket' => $ticket->id_ticket,
            'qr_code' => $qr_code_filename,
        ]);
    }

    public function showPaymentProof(Order $order)
    {

        $filePath = $order->payment_proof;
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'Gambar tidak ditemukan');
        }
        $imagePath = Storage::disk('public')->path($filePath);
        return response()->file($imagePath);
    }
}
