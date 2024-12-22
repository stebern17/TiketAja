<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

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

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5026',
            'location' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string',
            'category' => 'required|string',
        ]);

        // Combine location and venue into one field before storing
        $locationAndVenue = $validatedData['location'] . ', ' . $validatedData['venue'];

        // If there's an image, handle the upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Save the event to the database
        Event::create([
            'name' => $validatedData['name'],
            'date' => $validatedData['date'],
            'image' => $imagePath,
            'location' => $locationAndVenue, // Save combined location and venue
            'description' => $validatedData['description'] ?? null,
            'capacity' => $validatedData['capacity'],
            'status' => $validatedData['status'],
            'category' => $validatedData['category'],
        ]);


        // Redirect with success message
        return redirect()->route('events.index')->with('success', 'Event created successfully. You can now add tickets.');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Controller: EventController.php
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5026',
            'location' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string',
            'category' => 'required|string',
        ]);

        // Find the event by ID
        $event = Event::findOrFail($id);

        // Handle the image upload if exists
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($event->image && Storage::exists('public/' . $event->image)) {
                Storage::delete('public/' . $event->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $event->image = $imagePath;
        }

        // Combine location and venue into one field
        $locationAndVenue = $validatedData['location'] . ', ' . $validatedData['venue'];

        // Update the event data
        $event->update([
            'name' => $validatedData['name'],
            'date' => $validatedData['date'],
            'location' => $locationAndVenue,
            'description' => $validatedData['description'] ?? $event->description,
            'capacity' => $validatedData['capacity'],
            'status' => $validatedData['status'],
            'category' => $validatedData['category'],
        ]);

        // Redirect or return response
        return redirect()->route('events.index')->with('success', "Event {$event->name} berhasil diperbarui!");
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $eventName = $event->name; // Simpan nama event sebelum dihapus
        $event->delete();

        // Redirect dengan pesan flash berwarna merah
        return redirect()->route('events.index')->with('danger', "Event {$eventName} telah dihapus!");
    }
}
