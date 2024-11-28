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
        // Validasi form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string',
            'venue' => 'required|string',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Menyimpan data event ke database
        Event::create([
            'name' => $validatedData['name'],
            'date' => $validatedData['date'],
            'image' => $imagePath, // Menyimpan path gambar
            'location' => $validatedData['location'],
            'venue' => $validatedData['venue'],
            'description' => $validatedData['description'],
            'capacity' => $validatedData['capacity'],
            'status' => $validatedData['status'],
        ]);

        // Redirect setelah sukses
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
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

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if uploaded
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        // Find the event by ID
        $event = Event::findOrFail($id);

        // If there's an image, handle the upload
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($event->image && Storage::exists('public/images/' . $event->image)) {
                Storage::delete('public/images/' . $event->image);
            }

            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);

            // Update the image field in the database
            $event->image = $imageName;
        }

        // Update the rest of the event data
        $event->name = $request->input('name');
        $event->date = $request->input('date');
        $event->location = $request->input('location');
        $event->description = $request->input('description');
        $event->capacity = $request->input('capacity');
        $event->status = $request->input('status');

        // Save the updated event
        $event->save();

        // Redirect or return response
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
