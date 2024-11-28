@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <h1 style="margin-bottom:70px">List Events</h1>
    <table class="table table-striped mt-3 shadow rounded">
        <thead>
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->id_event }}</td>
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
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $events->links() }}
    </div>
</div>
@endsection