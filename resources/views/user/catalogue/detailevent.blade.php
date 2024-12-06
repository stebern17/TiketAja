@extends('layouts.userLayout')

@section('content')
    <div class="container">
        <h1>{{ $event->name }}</h1> <!-- Menampilkan nama event -->
        <p>{{ $event->description }}</p> <!-- Menampilkan deskripsi event -->
        <p><strong>Date:</strong> {{ $event->date }}</p> <!-- Menampilkan tanggal event -->
        <p><strong>Location:</strong> {{ $event->location }}</p> <!-- Menampilkan lokasi event -->
        <a href="{{ route('catalogue.index') }}" class="btn btn-primary">Back to Catalogue</a>
    </div>
@endsection