<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class CatalogueController extends Controller
{
    /**
     * Display the catalog of events.
     */
    public function index()
    {
        // Fetch the upcoming events (limit to 5)
        $events = Event::latest('date')  // Assuming events have a 'date' field
            ->take(5)  // Limit to 5 events
            ->get();

        // Return the view with the events data
        return view('user.catalogue.index', compact('events'));
    }

    /**
     * Show a specific event by its ID.
     */
    public function showEvent($id_event)
    {
        // Find the event by its ID
        $event = Event::findOrFail($id_event);

        // Pass the event to the view
        return view('user.catalogue.detailEvent', compact('event'));
    }
}
