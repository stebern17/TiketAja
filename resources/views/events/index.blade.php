@extends('layouts.adminLayout')

@section('title', 'Events Tiketku')

@section('content')
<div class="container">
    <h1 style="margin-bottom:70px">List Events</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('events.index') }}" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search events..." value="{{ request()->get('search') }}">
    </form>

    <table class="table table-striped mt-3 shadow rounded">
        <thead>
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($events->count() > 0)
            @foreach ($events as $key => $event)
            <tr>

                <td>{{ $events->firstItem() + $key }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->status }}</td>
                <td>
                    <a href="{{ route('events.show', $event->id_event) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('events.edit', $event->id_event) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('events.destroy', $event->id_event) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">No events found matching your search.</td>
            </tr>
            @endif
        </tbody>

    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $events->links() }}
    </div>
</div>
@endsection