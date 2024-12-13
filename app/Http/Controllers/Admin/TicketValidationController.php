<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\TicketValidation;
use App\Models\Ticket;
use App\Models\Event;
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
        $events = Event::select('id_event', 'name') // Adjust the column names to match your schema
            ->distinct()
            ->get();

        return view('admin.ticketValidation.validation', compact('events'));
    }

    /**
     * Validate the ticket using a QR code.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function validateTicket(Request $request)
    {
        // Validate the QR code input
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|exists:order_detail,qr_code', // Check if the QR code exists in the order_detail table
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid QR code.',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Retrieve the order detail by QR code
        $orderDetail = OrderDetail::where('qr_code', $request->qr_code)->first();

        if (!$orderDetail) {
            return response()->json([
                'success' => false,
                'message' => 'Order detail not found.',
            ], 404);
        }

        // Check if this ticket has already been validated
        $existingValidation = TicketValidation::where('id_order_detail', $orderDetail->id_order_detail)->first();

        if ($existingValidation) {
            return response()->json([
                'success' => false,
                'message' => 'This QR code has already been validated.',
            ], 400);
        }

        // Validate the ticket information (id_ticket, ticket type, and quantity)
        $ticketInfo = [
            'id_ticket' => $orderDetail->id_ticket,
            'id_order' => $orderDetail->id_order,
            'quantity' => $orderDetail->quantity,
        ];

        // Create a new ticket validation record
        $ticketValidation = TicketValidation::create([
            'id_order_detail' => $orderDetail->id_order_detail,
            'validation_date' => now(),
            'is_valid' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'QR code validated successfully.',
            'data' => [
                'id_ticket' => $ticketInfo['id_ticket'],
                'id_order' => $ticketInfo['id_order'],
                'quantity' => $ticketInfo['quantity'],
                'validation' => $ticketValidation,
            ],
        ], 200);
    }
}
