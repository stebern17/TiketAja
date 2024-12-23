@extends('layouts.adminLayout')

@section('title', 'Events Tiketku')

@section('content')
<div class="container my-5">
    <h1 class="text-center fw-bold mb-4" style="color: #4A5568;">List Events</h1>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i> {{ session('danger') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Search and Export -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Search Form -->
        <form method="GET" action="{{ route('events.index') }}" class="d-flex flex-grow-1 me-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search events..." value="{{ request()->get('search') }}">
                <button class="btn btn-secondary ms-2" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>

        <!-- Export Button -->
        <a href="{{ route('admin.events.export') }}" class="btn btn-success ms-3">
            <i class="bi bi-download"></i> Export Events
        </a>
    </div>

    <!-- Events Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table text-center">
                <tr>
                    <th>No</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Actions Tiket</th>
                </tr>
            </thead>
            <tbody>
                @if($events->count() > 0)
                @foreach ($events as $key => $event)
                <tr>
                    <td class="text-center">{{ $events->firstItem() + $key }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->status }}</td>
                    <td class="text-center">
                        <!-- View Button -->
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#eventDetailModal"
                            data-name="{{ $event->name }}" data-date="{{ $event->date }}"
                            data-image="{{ $event->image ? asset('storage/' . $event->image) : 'No image' }}"
                            data-location="{{ $event->location }}" data-venue="{{ $event->venue }}"
                            data-description="{{ $event->description }}" data-capacity="{{ $event->capacity }}"
                            data-status="{{ $event->status }}" data-category="{{ $event->category }}">View</a>

                        <!-- Edit Button -->
                        <a href="{{ route('events.edit', $event->id_event) }}" class="btn btn-warning btn-sm ms-2">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('events.destroy', $event->id_event) }}" method="POST" class="d-inline ms-2"
                            onsubmit="return confirm('Are you sure you want to delete the event {{ $event->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('tickets.create', $event->id_event) }}" class="btn btn-success btn-sm">
                            Buat Tiket
                        </a>
                        <a href="{{ route('tickets.index', $event->id_event) }}" class="btn btn-info btn-sm ms-2">
                            Lihat Tiket
                        </a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7" class="text-center">No events found matching your search.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $events->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modal for Event Details -->
<div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <img src="" class="card-img-top" id="modal-event-image" alt="Event Image">
                    <div class="card-body">
                        <h5 class="card-title font-bold" id="modal-event-name"></h5>
                        <span id="modal-description"></span><br>
                        <p class="card-text">
                            <strong>Date: </strong><span id="modal-event-date"></span><br>
                            <strong>Location: </strong><span id="modal-location"></span><br>
                            <strong>Capacity: </strong><span id="modal-capacity"></span><br>
                            <strong>Status: </strong><span id="modal-status"></span><br>
                            <strong>Category: </strong><span id="modal-category"></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#eventDetailModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var date = button.data('date');
        var image = button.data('image');
        var location = button.data('location');
        var venue = button.data('venue');
        var description = button.data('description');
        var capacity = button.data('capacity');
        var status = button.data('status');
        var category = button.data('category');

        $('#modal-event-name').text(name);
        $('#modal-event-date').text(date);
        $('#modal-event-image').attr('src', image);
        $('#modal-location').text(location);
        $("#modal-venue").text(venue);
        $('#modal-description').text(description);
        $('#modal-capacity').text(capacity);
        $('#modal-status').text(status);
        $('#modal-category').text(category);
    });
</script>

@endsection
