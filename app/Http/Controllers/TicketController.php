<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Menampilkan daftar tiket.
     */
    public function index()
    {
        $tickets = Ticket::with('event')->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Menampilkan form untuk membuat tiket baru.
     */
    public function create()
    {
        $events = Event::all(); // Mengambil semua event untuk dropdown
        return view('tickets.create', compact('events'));
    }

    /**
     * Menyimpan tiket baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_event' => 'required|exists:events,id_event',
            'type' => 'required|in:Regular,VIP,VVIP',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
            'qr_code' => 'required|string|max:255',
        ]);

        Ticket::create($request->all());
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat.');
    }

    /**
     * Menampilkan detail tiket.
     */
    public function show($id)
    {
        $ticket = Ticket::with('event')->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Menampilkan form untuk mengedit tiket.
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $events = Event::all();
        return view('tickets.edit', compact('ticket', 'events'));
    }

    /**
     * Memperbarui tiket di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_event' => 'required|exists:events,id_event',
            'type' => 'required|in:Regular,VIP,VVIP',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
            'qr_code' => 'required|string|max:255',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    /**
     * Menghapus tiket dari database.
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
