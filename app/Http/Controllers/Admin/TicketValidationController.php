<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\TicketValidation;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketValidationController extends Controller
{
    /**
     * Show the ticket validation page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showTicketValidationPage()
    {
        // Fetch events directly from the events table
        $events = Event::select('id_event', 'name')
            ->distinct()
            ->get();

        return view('admin.ticketValidation.validation', compact('events'));
    }

    public function fetchTicketData(Request $request)
    {
        $orderDetail = OrderDetail::find($request->id_order_detail);

        if (!$orderDetail) {
            return response()->json([
                'success' => false,
                'message' => 'Order detail not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id_ticket' => $orderDetail->id_ticket,
                'id_order' => $orderDetail->id_order,
            ],
        ], 200);
    }




    /**
     * Validate the ticket using a QR code or order detail ID.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function validateTicket(Request $request)
    {
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_ticket' => 'nullable|exists:tickets,id_ticket',
            'id_order' => 'nullable|exists:orders,id_order',
            'id_order_detail' => 'nullable|exists:order_detail,id_order_detail',
            'id_event' => 'required|exists:events,id_event',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Invalid input data.');
        }

        // Jika hanya id_order_detail yang diberikan, langsung lakukan validasi
        if ($request->id_order_detail) {
            $orderDetail = OrderDetail::find($request->id_order_detail);

            if (!$orderDetail) {
                return redirect()
                    ->back()
                    ->with('error', 'Order detail not found.');
            }

            // Validasi event ID terhadap tiket yang terkait
            $event = Event::find($request->id_event);
            if (!$event || $event->id_event !== $orderDetail->ticket->event->id_event) {
                return redirect()
                    ->back()
                    ->with('error', 'Event does not match the ticket\'s event.');
            }

            // Cek apakah tiket sudah pernah divalidasi sebelumnya
            if (TicketValidation::where('id_order_detail', $orderDetail->id_order_detail)->exists()) {
                return redirect()
                    ->back()
                    ->with('error', 'This ticket has already been validated.');
            }

            // Buat record validasi tiket
            TicketValidation::create([
                'id_order_detail' => $orderDetail->id_order_detail,
                'id_order' => $orderDetail->id_order,
                'id_ticket' => $orderDetail->id_ticket,
                'validation_date' => now(),
                'is_valid' => true,
            ]);

            return redirect()
                ->back()
                ->with('success', 'Ticket validated successfully.');
        }

        return redirect()
            ->back()
            ->with('error', 'No valid ticket or order found.');
    }
}
