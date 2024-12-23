<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Mengambil order dengan relasi 'ticket', 'event', dan 'orderDetails' yang sesuai dengan user_id
        $order = Order::with(['ticket', 'event', 'orderDetails'])
            ->where('id_user', $userId)
            ->get();

        return view('user.order.index', compact('order'));
    }



    public function create(Request $request)
    {
        $tickets = Ticket::all();
        return view('user.catalogue.detailevent', compact('tickets'));
    }


    public function store(Request $request)
    {
        // Validasi input awal (sebelum upload proof)
        $request->validate([
            'id_ticket' => 'required|exists:tickets,id_ticket',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil data tiket
        $ticket = Ticket::findOrFail($request->id_ticket);

        // Hitung total harga
        $totalPrice = $ticket->price * $request->quantity;

        // Simpan data sementara untuk ditampilkan di checkout
        $checkoutData = [
            'id_ticket' => $ticket->id_ticket,
            'id_event' => $ticket->event->id_event,
            'ticket_type' => $ticket->type,
            'ticket_price' => $ticket->price,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ];

        // Arahkan ke halaman checkoutOrder
        return view('user.order.checkoutOrder', compact('checkoutData'))->with('success', 'Order successfully created!');
    }

    public function confirm(Request $request)
    {
        // Validasi bukti pembayaran

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'id_ticket' => 'required|exists:tickets,id_ticket',
            'id_event' => 'required|exists:events,id_event',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|integer',
        ]);


        // Simpan bukti pembayaran
        $paymentProofPath = $request->file('payment_proof')->store('payments', 'public');

        $user = Auth::user();


        // Simpan data order ke database
        Order::create([
            'id_user' => $user->id,
            'id_event' => $request->id_event,
            'id_ticket' => $request->id_ticket,
            'ticket_code' => $request->id_ticket,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'payment_proof' => $paymentProofPath,
            'status' => 'pending',
        ]);



        return redirect()->route('order.index')->with('success', 'Order successfully created!');
    }


    public function show(Order $order)
    {
        return view('user.order.Ticketshow', compact('order'));
    }

    public function ShowEventOrder($id_order)
    {
        // Pastikan order ada sebelum mengakses propertinya
        $order = Order::with(['ticket', 'event'])->findOrFail($id_order);

        // Ambil event yang terkait dengan tiket
        $event = $order->ticket->event;

        return redirect()->route('user.catalogue.showEvent', ['id_event' => $event->id_event]);
    }

    public function edit(Order $order)
    {
        $tickets = Ticket::all();
        return view('orders.edit', compact('order', 'tickets'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'id_tikcet' => 'required|exists:tickets,id_ticket',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $totalPrice = $ticket->price * $request->quantity;

        $order->update([
            'id_ticket' => $request->id_ticket,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order successfully updated!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order successfully deleted!');
    }
}
