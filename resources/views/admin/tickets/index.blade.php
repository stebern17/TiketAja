@extends('layouts.adminLayout')
@section('title', 'Ticket Tiketku')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                </div>
                <div class="card-body">
                    {{-- Informasi Event --}}
                    <div class="mb-3">
                        <label for="event_name" class="form-label">Event</label>
                        <input type="text" class="form-control" id="event_name" value="{{ $event->name }}" readonly>
                    </div>

                    {{-- Tiket Terkait --}}
                    <div class="mb-3">
                        <h5>Daftar Tiket untuk Event "{{ $event->name }}"</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>QrCode</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event->tickets as $index => $ticket)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $ticket->type }}</td>
                                        <td>{{ number_format($ticket->price, 0, ',', '.') }}</td>
                                        <td>{{ $ticket->quantity }}</td>
                                        <td>{{ $ticket->qr_code }}</td>
                                        <td>
                                            {{-- Edit --}}
                                            <a href="{{ route('tickets.edit', $ticket->id_ticket) }}" class="btn btn-warning btn-sm">Edit</a>

                                            {{-- Delete --}}
                                            <form action="{{ route('tickets.destroy', $ticket->id_ticket) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-grid">
                        <a href="{{ route('events.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
