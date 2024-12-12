@extends('layouts.userLayout')

@section('content')
<div class="container">
    <section class="shadow-lg p-2 rounded-lg bg-white">
        <img src="{{ 'https://picsum.photos/200/300?random=' . rand(1, 1000) }}" alt="img-card" class="w-full h-[30vh] rounded-lg object-cover" />
        <div class="mt-2 border-b-2 py-2">
            <p class="text-2xl text-danger font-medium ">{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y') }}</p>
            <h1 class="text-4xl font-semibold">{{ $event->name }}</h1>
        </div>

        <div class="py-2">
            <p><i class="bi bi-geo-fill"></i> {{ $event->location }}</p>
            <div class="mt-2">
                <h5 class="text-xl font-bold">Tentang Event</h5>
                <p class="text-m">{{ $event->description }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-lg mt-3">
        <div class="container mx-auto py-8">
            <div class="flex mb-4">
                <ul class="flex space-x-8">
                    <li>
                        <a href="#" id="tab1" class="tab-link text-blue-600 border-b-2 border-transparent hover:border-blue-600 pb-2 px-4">Syarat dan Ketentuan</a>
                    </li>
                    <li>
                        <a href="{{ route('tickets.index', ['event' => $event->id_event]) }}" id="tab2" class="tab-link text-blue-600 border-b-2 border-transparent hover:border-blue-600 pb-2 px-4">Tiket</a>

                    </li>
                </ul>
            </div>

           <!-- Tab Content: Tiket -->
           <div id="tab2-content" class="tab-content hidden">
                <div class="tickets grid grid-cols-1 gap-4 lg:grid-cols-2">
                    @foreach ($event->tickets as $ticket) <!-- Loop through each ticket for the event -->
                    <div class="ticket bg-primary-50 flex flex-col gap-8 rounded-xl p-6">
                        {{-- <div class="w-full h-48">
                            <img src="{{ asset('storage/images/' . $ticket->image) }}" alt="Ticket Image" class="w-full h-full object-cover rounded-t-lg">
                        </div> --}}
                        <div class="bg-gray-100 flex flex-col gap-4 rounded-xl p-6">
                            <h2 class="text-primary-900 text-lg font-semibold">{{ $ticket->type }} Ticket</h2>
                            <span class="text-sm text-gray-500 md:text-base">{{ $ticket->description }}</span>
                            <h4 class="text-primary-900 text-xl font-bold md:text-3xl">Rp {{ number_format($ticket->price, 0, ',', '.') }}</h4>

                            <!-- Quantity Form -->
                            <form action="{{ route('order.store') }}" method="POST" class="mt-4">
                                @csrf
                                {{-- mengambil data untuk create --}}
                                <input type="hidden" name="id_ticket" value="{{ $ticket->id_ticket}}">
                                <input type="hidden" name="id_event" value="{{ $event->id_event }}">
                                <input type="hidden" name="customer_name" value="{{ Auth::user()->name_user }}">
                                <input type="hidden" name="customer_email" value="{{ Auth::user()->email_user }}">

                                <div class="flex items-center space-x-4">
                                    <input type="number" name="quantity" min="1" max="{{ $ticket->quantity }}" value="1" class="w-20 p-2 border rounded-md" required>
                                    <p class="text-sm text-gray-500">Max available: {{ $ticket->quantity }}</p>
                                </div>
                                <button type="submit" class="mt-4 w-full py-2 px-4 text-center text-white rounded-lg border border-primary-900 bg-blue-900 hover:bg-primary-950 duration-200 ">
                                    Buy Ticket
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

</div>
@endsection





