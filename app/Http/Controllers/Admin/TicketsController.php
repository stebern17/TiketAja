<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tickets;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $tickets = $event->tickets;  // Mengambil tiket terkait dengan event
        return view('admin.tickets.index', compact('tickets', 'event'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($event_id)
    {

        $event = Event::findOrFail($event_id);
        return view('admin.tickets.create', compact('event'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'types' => 'required|array',
            'types.*' => 'in:Regular,VIP,VVIP',
            'prices' => 'required|array',
            'prices.*' => 'nullable|integer|min:0',
            'quantity' => 'required|array',
            'quantity.*' => 'nullable|integer|min:1',
        ]);

        $event = Event::findOrFail($request->id_event);
        $existingTickets = Tickets::where('id_event', $request->id_event)->sum('quantity');
        $newTicketsTotal = array_sum($request->quantity);

        if (($existingTickets + $newTicketsTotal) > $event->capacity) {
            return redirect()->back()->with('error', 'Jumlah total tiket melebihi kapasitas event.');
        }

        foreach ($request->types as $type) {
            Tickets::create([
                'id_event' => $request->id_event,
                'type' => $type,
                'price' => $request->prices[$type] ?? 0,
                'quantity' => $request->quantity[$type] ?? 0,
            ]);
        }



        return redirect()->route('events.index')->with('success', 'Ticket Berhasil Dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        // Kirimkan $ticket ke view
        return view('admin.tickets.view', compact('event'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $ticket = Tickets::findOrFail($id);
        return view('admin.tickets.edit', compact('ticket'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari tiket berdasarkan ID
        $ticket = Tickets::findOrFail($id);

        // Validasi data form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Validasi untuk jenis tiket
            'price' => 'required|integer|min:0', // Validasi untuk harga
            'quantity' => 'required|integer|min:1', // Validasi untuk kuantitas
        ]);

        // Update data tiket dengan data yang sudah divalidasi
        $ticket->update([
            'type' => $validatedData['name'], // Menyimpan jenis tiket (VIP, Regular, VVIP)
            'price' => $validatedData['price'], // Menyimpan harga
            'quantity' => $validatedData['quantity'], // Menyimpan kuantitas
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('tickets.index', ['event' => $ticket->id_event])->with('success', 'Ticket berhasil diperbarui.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete
        $ticket = Tickets::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index', ['event' => $ticket->id_event])->with('success', 'Ticket Berhasil Dihapus.');
    }
}
