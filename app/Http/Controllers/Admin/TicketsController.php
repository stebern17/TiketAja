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
    public function index()
    {
        $tickets = Tickets::with('event')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($event_id)
    {
        $event = Event::find($event_id);
        // dd($event);
        return view('admin.tickets.create', compact('event'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'types' => 'required|array',
            'types.*' => 'in:Regular,VIP,VVIP',
            'prices' => 'required|array',
            'prices.Regular' => 'nullable|integer|min:0',
            'prices.VIP' => 'nullable|integer|min:0',
            'prices.VVIP' => 'nullable|integer|min:0',
            'quantity' => 'required|array',
            'quantity.Regular' => 'nullable|integer|min:1',
            'quantity.VIP' => 'nullable|integer|min:1',
            'quantity.VVIP' => 'nullable|integer|min:1',
            'qr_code' => 'required|string|max:255',
        ]);

        foreach ($request->types as $type) {
            Tickets::create([
                'id_event' => $request -> id_event,
                'type' => $type,
                'price' => $request->prices[$type] ?? 0,
                'quantity' => $request->quantity[$type] ?? 0,
                'qr_code' => $request->qr_code,
            ]);
        }




        return redirect()->route('events.index')->with('success', 'Ticket Berhasil Dibuat.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Cari ticket berdasarkan ID
        $ticket = Tickets::findOrFail($id);

        // Kirimkan $ticket ke view
        return view('admin.tickets.show', compact('ticket'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
