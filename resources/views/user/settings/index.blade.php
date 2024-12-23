@extends('layouts.userLayout')

@section('title', 'User Settings')

@section('content')
<div class="container mt-5">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-blue-800 text-white">
      <h3 class="mb-0">User Settings</h3>
    </div>
    <div class="card-body">
      <div class="mx-auto text-center mb-4">
        <i class="bi bi-person-circle icon-large"></i>
        <h5 class="mt-2 fs-2 fw-bold">Hi, {{ $user->name_user }}</h5>
      </div>
      <!-- Flash Message -->
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <!-- Form untuk Mengubah Nama -->
      <form method="POST" action="{{ route('user.settings.update') }}">
        @csrf
        <div class="mb-4">
          <label for="name_user" class="form-label fw-bold">Full Name</label>
          <input type="text" class="form-control rounded-pill" id="name_user" name="name_user" value="{{ old('name_user', $user->name_user) }}" required>
          @error('name_user')
          <div class="text-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Tampilkan Email (hanya baca) -->
        <div class="mb-4">
          <label for="email_user" class="form-label fw-bold">Email Address</label>
          <input type="email" class="form-control rounded-pill bg-light" id="email_user" value="{{ $user->email_user }}" disabled>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary  bg-blue-800 rounded-pill px-4">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
