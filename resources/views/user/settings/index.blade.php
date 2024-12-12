@extends('layouts.userLayout')

@section('title', 'Settings')

@section('content')
<div class="container">
  <!-- Account Information Title -->
  <h1 class="mt-5" style="font-size: 2.5rem; font-weight: bold;">Account Information</h1>

  <!-- Profile Photo -->
  <div class="mb-4">
    <h3 class="my-4" style="font-weight: 600; font-size: 1.5rem;">Profile Photo</h3>
    <div class="d-flex align-items-center">
      <img src="{{ asset('path/to/default-profile.png') }}" alt="Profile Photo" class="rounded-circle" width="120"
        height="120">
      <div class="ms-3">
        <label for="profile_photo" class="form-label">Upload New Photo:</label>
        <input type="file" id="profile_photo" name="profile_photo" class="form-control">
      </div>
    </div>
  </div>

  <!-- Profile Information -->
  <div class="mb-4">
    <h3 class="my-4" style="font-weight: 600; font-size: 1.5rem;">Profile Information</h3>
    <form class="d-flex flex-column" style="width: 50%;">
      <div class="mb-3 d-flex align-items-center">
        <label for="name_user" class="form-label" style="font-weight: bold; width: 30%;">Name:</label>
        <input type="text" id="name_user" name="name_user" class="form-control" placeholder="Your Name"
          style="flex-grow: 1;">
      </div>
      <div class="mb-3 d-flex align-items-center">
        <label for="website" class="form-label" style="font-weight: bold; width: 30%;">Website:</label>
        <input type="url" id="website" name="website" class="form-control" placeholder="https://example.com"
          style="flex-grow: 1;">
      </div>
      <div class="mb-3 d-flex align-items-center">
        <label for="company" class="form-label" style="font-weight: bold; width: 30%;">Company:</label>
        <input type="text" id="company" name="company" class="form-control" placeholder="Your Company"
          style="flex-grow: 1;">
      </div>
    </form>
  </div>

  <!-- Contact Details -->
  <div class="mb-4">
    <h3 class="my-4" style="font-weight: 600; font-size: 1.5rem;">Contact Details</h3>
    <form class="d-flex flex-column" style="width: 50%;">
      <div class="mb-3 d-flex align-items-center">
        <label for="phone_number" class="form-label" style="font-weight: bold; width: 30%;">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="Your Phone Number"
          style="flex-grow: 1;">
      </div>
      <div class="mb-3 d-flex align-items-center">
        <label for="address" class="form-label" style="font-weight: bold; width: 30%;">Address:</label>
        <input type="text" id="address" name="address" class="form-control" placeholder="Your Address"
          style="flex-grow: 1;">
      </div>
      <div class="mb-3 d-flex align-items-center">
        <label for="city" class="form-label" style="font-weight: bold; width: 30%;">City/Town:</label>
        <input type="text" id="city" name="city" class="form-control" placeholder="Your City/Town"
          style="flex-grow: 1;">
      </div>
      <div class="mb-3 d-flex align-items-center">
        <label for="country" class="form-label" style="font-weight: bold; width: 30%;">Country:</label>
        <input type="text" id="country" name="country" class="form-control" placeholder="Your Country"
          style="flex-grow: 1;">
      </div>
      <div class="mb-3 d-flex align-items-center">
        <label for="passcode" class="form-label" style="font-weight: bold; width: 30%;">Passcode:</label>
        <input type="text" id="passcode" name="passcode" class="form-control" placeholder="Your Passcode"
          style="flex-grow: 1;">
      </div>
    </form>
  </div>

  <!-- Save Button -->
  <div class="mb-4">
    <button type="submit" class="btn btn-primary">Save My Profile</button>
  </div>
</div>
@endsection