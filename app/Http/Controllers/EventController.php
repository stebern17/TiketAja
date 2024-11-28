<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $events = Event::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|max:255',
            'venue' => 'required|max:255',  // Added venue validation
            'description' => 'nullable',
            'capacity' => 'required|integer',
            'status' => 'required|in:Ongoing,Upcoming,Done',
        ]);

        // Combine location and venue into a single string
        $locationAndVenue = $request->location . ', ' . $request->venue;

        // Prepare the data to store in the database
        $data = $request->all();
        $data['location'] = $locationAndVenue; // Store the combined location and venue in the location column

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('event_images', 'public');
        }

        // Create the event
        Event::create($data);

        // Redirect with success message
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Controller: EventController.php
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'venue' => 'required|string|max:255',  // Added venue validation
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Combine location and venue into a single string
        $locationAndVenue = $validated['location'] . ', ' . $validated['venue'];

        // Update the event with the new data
        $event->name = $validated['name'];
        $event->date = $validated['date'];
        $event->location = $locationAndVenue; // Store the combined location and venue in the location column
        $event->description = $validated['description'];
        $event->capacity = $validated['capacity'];
        $event->status = $validated['status'];

        // Handle file upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $event->image = $imagePath;
        }

        // Save the changes to the event
        $event->save();

        // Redirect with success message
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $events = Event::findOrFail($id);
        $events->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
