@extends('layouts.adminLayout')

@section('title', 'Tickets Tiketku')

@section('content')
<div class="container mt-5">
  <h1 class="mb-4">Edit Ticket</h1>

  <!-- Form Edit Ticket -->
  <form action="{{ route('tickets.update', $ticket->id_ticket) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Nama Ticket -->
    <div class="mb-3">
        <label for="name" class="form-label">Ticket Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            placeholder="Enter ticket name" value="{{ old('name', $ticket->type ?? '') }}" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Harga Ticket -->
    <div class="mb-3">
      <label for="price" class="form-label">Ticket Price</label>
      <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
        placeholder="Enter ticket price" value="{{ old('price', $ticket->price) }}" required>
      @error('price')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Kuota Ticket -->
    <div class="mb-3">
      <label for="quantity" class="form-label">Quantity</label>
      <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity"
        placeholder="Enter ticket quantity" value="{{ old('quantity', $ticket->quantity) }}" required>
      @error('quantity')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- qr code --}}
    <div class="mb-3">
        <label for="qr_code" class="form-label">QR Code</label>
        <input type="text" class="form-control @error('qr_code') is-invalid @enderror" id="qr_code" name="qr_code"
            placeholder="Enter QR Code" value="{{ old('qr_code', $ticket->qr_code) }}" required>
        @error('qr_code')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Edit Ticket</button>
    </form>
</div>
@endsection



