@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create Event</h1>

    <!-- Form Pembuatan Event -->
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded">
        @csrf

        <!-- Nama Event -->
        <div class="mb-3">
            <label for="name" class="form-label">Event Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="Enter event name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Event -->
        <div class="mb-3">
            <label for="date" class="form-label">Event Date</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                value="{{ old('date') }}" required>
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Upload Gambar -->
        <div class="mb-3">
            <label for="image" class="form-label">Event Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                accept=".jpeg, .png, .jpg, .gif">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lokasi -->
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <select class="form-control @error('location') is-invalid @enderror" id="location" name="location" required>
                <option value="">Select Location</option>
                <option value="Yogyakarta" {{ old('location') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                <option value="Solo" {{ old('location') == 'Solo' ? 'selected' : '' }}>Solo</option>
                <option value="Semarang" {{ old('location') == 'Semarang' ? 'selected' : '' }}>Semarang</option>
            </select>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Venue</label>
            <input type="text" class="form-control @error('venue') is-invalid @enderror" id="venue" name="venue"
                placeholder="Enter event venue" value="{{ old('venue') }}" required>
            @error('venue')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" rows="3"
                placeholder="Enter event description (optional)">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kapasitas -->
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                name="capacity" placeholder="Enter event capacity" value="{{ old('capacity') }}" min="1" required>
            @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="" selected disabled>Select status</option>
                <option value="Ongoing" {{ old('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="Upcoming" {{ old('status') == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection