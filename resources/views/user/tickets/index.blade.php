@extends('layouts.userLayout')

@section('title', 'Tiket Aja - Event Tickets')

@section('content')
<!-- Tiket yang tersedia untuk event tertentu -->
<div class="tickets grid grid-cols-1 gap-4 lg:grid-cols-2">
    @foreach ($tickets as $ticket)
    <div class="ticket bg-primary-50 ticket flex flex-col gap-8 rounded-xl p-6">
        <img src="{{ asset('storage/images/' . $ticket->image) }}" alt="Ticket Image" class="w-full h-48 object-cover rounded-t-lg">
        <div class="bg-gray-100 ticket flex flex-col gap-8 rounded-xl p-6">
            <h2 class="text-primary-900 text-lg font-semibold">{{ $ticket->name }}</h2>
            <span class="text-sm text-gray-500 md:text-base">{{ $ticket->description }}</span>
            <h4 class="text-primary-900 text-xl font-bold md:text-3xl">{{ $ticket->price }}</h4>
            <button type="button" class="w-fit">
                <a href="#" class="w-full inline-block py-2 px-4 text-center text-white rounded-lg border border-primary-900 bg-primary-900 border-primary-900 hover:bg-primary-950 duration-200">Beli Tiket</a>
            </button>
        </div>
    </div>
    @endforeach
</div>
@endsection


