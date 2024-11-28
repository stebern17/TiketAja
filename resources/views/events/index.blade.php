@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <h1 style="margin-bottom:70px">List Events</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('events.index') }}" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search events..."
            value="{{ request()->get('search') }}">
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
                            <!-- Tombol View untuk membuka modal -->
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#eventDetailModal"
                                data-name="{{ $event->name }}" data-date="{{ $event->date }}"
                                data-image="{{ $event->image ? asset('storage/' . $event->image) : 'No image' }}"
                                data-location="{{ $event->location }}" data-venue="{{ $event->venue }}"
                                data-description="{{ $event->description }}" data-capacity="{{ $event->capacity }}"
                                data-status="{{ $event->status }}">View</a>


                            <!-- Tombol Edit -->
                            <a href="{{ route('events.edit', $event->id_event) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Tombol Delete -->
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

<div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <!-- Menampilkan gambar event -->
                    <img src="" class="card-img-top" id="modal-event-image" alt="Event Image">
                    <div class="card-body">
                        <h5 class="card-title font-bold" id="modal-event-name"></h5>
                        <span id="modal-description"></span><br>
                        <p class="card-text">
                            <strong>Date: </strong><span id="modal-event-date"></span><br>
                            <strong>Location: </strong><span id="modal-location"></span><br>
                            <strong>Capacity: </strong><span id="modal-capacity"></span><br>
                            <strong>Status: </strong><span id="modal-status"></span>
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

<!-- JavaScript untuk mengisi data modal -->
<script>
    $('#eventDetailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var name = button.data('name');
        var date = button.data('date');
        var image = button.data('image');
        var location = button.data('location');
        var venue = button.data('venue');
        var description = button.data('description');
        var capacity = button.data('capacity');
        var status = button.data('status');

        // Menampilkan data di modal
        $('#modal-event-name').text(name);
        $('#modal-event-date').text(date);
        $('#modal-event-image').attr('src', image);  // Mengubah src image
        $('#modal-location').text(location);
        $("#modal-venue").text(venue);
        $('#modal-description').text(description);
        $('#modal-capacity').text(capacity);
        $('#modal-status').text(status);
    });
</script>



@endsection