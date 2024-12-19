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
            'id_order_detail' => 'nullable|exists:order_details,id_order_detail',
            'id_event' => 'required|exists:events,id_event',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input data.',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Jika hanya id_order_detail yang diberikan, langsung lakukan validasi
        if ($request->id_order_detail) {
            $orderDetail = OrderDetail::find($request->id_order_detail);

            if (!$orderDetail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order detail not found.',
                ], 404);
            }

            // Validasi event ID terhadap tiket yang terkait
            $event = Event::find($request->id_event);
            if (!$event || $event->id_event !== $orderDetail->ticket->event->id_event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Event does not match the ticket\'s event.',
                ], 404);
            }

            // Cek apakah tiket sudah pernah divalidasi sebelumnya
            if ($orderDetail->ticketValidation) {
                return response()->json([
                    'success' => false,
                    'message' => 'This ticket has already been validated.',
                ], 400);
            }

            // Buat record validasi tiket
            TicketValidation::create([
                'id_order_detail' => $orderDetail->id_order_detail,
                'id_order' => $orderDetail->id_order,
                'id_ticket' => $orderDetail->id_ticket,
                'validation_date' => now(),
                'is_valid' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ticket validated successfully.',
                'data' => [
                    'id_ticket' => $orderDetail->id_ticket,
                    'id_order' => $orderDetail->id_order,
                    'event' => $event->name,
                ],
            ], 200);
        }

        // Jika id_ticket dan id_order diberikan (misalnya dari QR Code), proses sesuai data tersebut
        // if ($request->id_ticket && $request->id_order) {
        //     // Proses berdasarkan QR Code
        //     $ticket = Ticket::find($request->id_ticket);
        //     $order = Order::find($request->id_order);

        //     if (!$ticket || !$order) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Ticket or Order not found.',
        //         ], 404);
        //     }

        //     // Validasi jenis tiket berdasarkan event
        //     $event = Event::find($request->id_event);
        //     if ($event->id_event !== $ticket->event->id_event) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Event does not match the ticket\'s event.',
        //         ], 404);
        //     }

        //     // Cek apakah tiket sudah pernah divalidasi sebelumnya
        //     if ($ticket->ticketValidation) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'This ticket has already been validated.',
        //         ], 400);
        //     }

        //     // Buat record validasi tiket
        //     TicketValidation::create([
        //         'id_order_detail' => $order->orderDetails->first()->id_order_detail,
        //         'id_order' => $order->id_order,
        //         'id_ticket' => $ticket->id_ticket,
        //         'validation_date' => now(),
        //         'is_valid' => true,
        //     ]);

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Ticket validated successfully.',
        //         'data' => [
        //             'id_ticket' => $ticket->id_ticket,
        //             'id_order' => $order->id_order,
        //             'event' => $event->name,
        //         ],
        //     ], 200);
        // }

        // Jika data tidak valid
        return response()->json([
            'success' => false,
            'message' => 'No valid ticket or order found.',
        ], 400);
    }
}
