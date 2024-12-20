@extends('layouts.adminLayout')

@section('title', 'Events Tiketku')

@section('content')
<div class="container">
    <h1 class="mb-4 mt-2" style="font-weight: bold; color: #333;">Create Event</h1>

    <!-- Form Pembuatan Event -->
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded" style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        @csrf

        <div class="row">
            <!-- Nama Event -->
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label" style="font-weight: bold; color: #333;">Event Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="Enter event name" value="{{ old('name') }}" required style="border-radius: 4px; padding: 10px;">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tanggal Event -->
            <div class="mb-3 col-md-6">
                <label for="date" class="form-label" style="font-weight: bold; color: #333;">Event Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                    value="{{ old('date') }}" required style="border-radius: 4px; padding: 10px;">
                @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <!-- Lokasi -->
            <div class="col-md-6">
                <label for="location" class="form-label" style="font-weight: bold; color: #333;">Location</label>
                <select class="form-select @error('location') is-invalid @enderror" id="location" name="location" required style="border-radius: 4px; padding: 10px;">
                    <option value="" selected disabled>Select Location</option>
                    <option value="Jakarta" {{ old('location') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                    <option value="Surabaya" {{ old('location') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                    <option value="Bandung" {{ old('location') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    <option value="Medan" {{ old('location') == 'Medan' ? 'selected' : '' }}>Medan</option>
                    <option value="Yogyakarta" {{ old('location') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                    <option value="Makassar" {{ old('location') == 'Makassar' ? 'selected' : '' }}>Makassar</option>
                    <option value="Semarang" {{ old('location') == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                    <option value="Denpasar" {{ old('location') == 'Denpasar' ? 'selected' : '' }}>Denpasar</option>
                    <option value="Palembang" {{ old('location') == 'Palembang' ? 'selected' : '' }}>Palembang</option>
                    <option value="Batam" {{ old('location') == 'Batam' ? 'selected' : '' }}>Batam</option>
                    <option value="Banjarmasin" {{ old('location') == 'Banjarmasin' ? 'selected' : '' }}>Banjarmasin</option>
                    <option value="Balikpapan" {{ old('location') == 'Balikpapan' ? 'selected' : '' }}>Balikpapan</option>
                    <option value="Tangerang" {{ old('location') == 'Tangerang' ? 'selected' : '' }}>Tangerang</option>
                    <option value="Cimahi" {{ old('location') == 'Cimahi' ? 'selected' : '' }}>Cimahi</option>
                </select>
                @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Venue -->
            <div class="col-md-6">
                <label for="venue" class="form-label" style="font-weight: bold; color: #333;">Venue</label>
                <input type="text" class="form-control @error('venue') is-invalid @enderror" id="venue" name="venue"
                    placeholder="Enter event venue" value="{{ old('venue') }}" required style="border-radius: 4px; padding: 10px;">
                @error('venue')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="description" class="form-label" style="font-weight: bold; color: #333;">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" rows="3"
                placeholder="Enter event description (optional)" style="border-radius: 4px; padding: 10px;">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <!-- Category -->
            <div class="col-md-6">
                <label for="category" class="form-label" style="font-weight: bold; color: #333;">Category</label>
                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required style="border-radius: 4px; padding: 10px;">
                    <option value="" selected disabled>Select category</option>
                    <option value="Music" {{ old('category') == 'Music' ? 'selected' : '' }}>Music</option>
                    <option value="Sport" {{ old('category') == 'Sport' ? 'selected' : '' }}>Sport</option>
                    <option value="Seminar" {{ old('category') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                    <option value="Workshop" {{ old('category') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                </select>
                @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Capacity -->
            <div class="col-md-6">
                <label for="capacity" class="form-label" style="font-weight: bold; color: #333;">Capacity</label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                    name="capacity" placeholder="Enter event capacity" value="{{ old('capacity') }}" min="1" required style="border-radius: 4px; padding: 10px;">
                @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <!-- Status -->
            <div class="col-md-6">
                <label for="status" class="form-label" style="font-weight: bold; color: #333;">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required style="border-radius: 4px; padding: 10px;">
                    <option value="" selected disabled>Select status</option>
                    <option value="Ongoing" {{ old('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="Upcoming" {{ old('status') == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Tombol Submit untuk Event -->
        <button type="submit" class="btn" style="background-color: #5F9EA0; color: white; font-weight: bold; border-radius: 4px;">Create Event</button>
    </form>
</div>
@endsection
