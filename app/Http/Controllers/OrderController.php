<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('ticket')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $tickets = Ticket::all();
        return view('orders.create', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $totalPrice = $ticket->price * $request->quantity;

        Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'ticket_id' => $request->ticket_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order successfully created!');
    }


    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $tickets = Ticket::all();
        return view('orders.edit', compact('order', 'tickets'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $totalPrice = $ticket->price * $request->quantity;

        $order->update([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'ticket_id' => $request->ticket_id,
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
