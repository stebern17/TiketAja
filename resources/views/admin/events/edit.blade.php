@extends('layouts.adminLayout')

@section('title', 'Events Tiketku')

@section('content')
<div class="container ">
  <h1 class="mb-4 mt-2">Edit Event</h1>

  <!-- Form Edit Event -->
  <form action="{{ route('events.update', $event->id_event) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Nama Event -->

    <div class="mb-3">
      <label for="name" class="form-label">Event Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        placeholder="Enter event name" value="{{ old('name', $event->name) }}" required>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Tanggal Event -->

    <div class="row mb-3">
      <div class="col">
        <label for="date" class="form-label">Event Date</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
          value="{{ old('date', $event->date) }}" required>
        @error('date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="image" class="form-label">Event Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
          accept=".jpeg, .png, .jpg, .gif">
        @if($event->image)
        <div class="mt-2">
          <p>Current Image:</p>
          <img src="{{ asset('storage/images/' . $event->image) }}" alt="Event Image" class="mt-2" width="100">
        </div>
        @endif
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>



    <!-- Lokasi -->
    <div class="row mb-3">
      <div class="col">
        <label for="location" class="form-label">Location</label>
        <select class="form-control @error('location') is-invalid @enderror" id="location" name="location" required>
          <option value="">Select Location</option>
          <option value="Yogyakarta" {{ old('location', explode(', ', $event->location)[0] ?? '') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
          <option value="Solo" {{ old('location', explode(', ', $event->location)[0] ?? '') == 'Solo' ? 'selected' : '' }}>Solo</option>
          <option value="Semarang" {{ old('location', explode(', ', $event->location)[0] ?? '') == 'Semarang' ? 'selected' : '' }}>Semarang</option>
        </select>
        @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col">
        <label for="venue" class="form-label">Venue</label>
        <input type="text" class="form-control @error('venue') is-invalid @enderror" id="venue" name="venue"
          placeholder="Enter event venue" value="{{ old('venue', explode(', ', $event->location)[1] ?? '') }}" required>
        @error('venue')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

    </div>
    <!-- Deskripsi -->
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
        rows="3"
        placeholder="Enter event description (optional)">{{ old('description', $event->description) }}</textarea>
      @error('description')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="row mb-3">
      <!-- Category -->
      <div class="col">
        <label for="category" class="form-label">Category</label>
        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
          <option value="" selected disabled>Select category</option>
          <option value="Music" {{ old('category') == 'Music' ? 'selected' : '' }}>Music</option>
          <option value="Sport" {{ old('category') == 'Sport' ? 'selected' : '' }}>Sport</option>
          <option value="Seminar" {{ old('category') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
          <option value="Workshop" {{ old('category') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
        </select>
        @error('category')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <!-- Kapasitas -->
      <div class="col">
        <label for="capacity" class="form-label">Capacity</label>
        <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity"
          placeholder="Enter event capacity" value="{{ old('capacity', $event->capacity) }}" min="1" required>
        @error('capacity')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Status -->
      <div class="col">
        <label for="status" class="form-label">Status</label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
          <option value="" disabled>Select status</option>
          <option value="Ongoing" {{ old('status', $event->status) == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
          <option value="Upcoming" {{ old('status', $event->status) == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
          <option value="Done" {{ old('status', $event->status) == 'Done' ? 'selected' : '' }}>Done</option>
        </select>
        @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>


    </div>


    <!-- Tombol Submit -->
    <button type="submit" class="btn btn-primary">Update Event</button>
  </form>
</div>
@endsection