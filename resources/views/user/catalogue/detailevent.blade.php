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
                        <a href="#" id="tab2" class="tab-link text-blue-600 border-b-2 border-transparent hover:border-blue-600 pb-2 px-4">Tiket</a>
                    </li>
                </ul>
            </div>

            <!-- Tab Content: Syarat dan Ketentuan -->
            <div id="tab1-content" class="tab-content">
                <div class="flex space-x-6">
                    <div>
                        <h2 class="text-xl font-bold mb-4">Syarat dan Ketentuan Event</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae quisquam enim quia neque facilis voluptatum iure maiores pariatur ratione commodi minima eaque sequi laborum voluptates quam earum, nulla nisi totam!</p>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Tiket -->
            <div id="tab2-content" class="tab-content hidden">
                <div class="flex space-x-6">
                    @foreach ($event->tickets as $ticket) <!-- Loop through each ticket for the event -->
                    <div class="bg-white shadow-lg rounded-lg p-6 w-full md:w-1/3">
                        <h3 class="text-2xl font-bold mb-2">{{ $ticket->type }} Ticket</h3>
                        <p class="text-lg font-semibold text-orange-500">Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>

                        <!-- Quantity Form -->
                        <form action="{{ route('orders.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <input type="hidden" name="customer_name" value="Anonymous"> <!-- You can replace this with dynamic data from user authentication if needed -->
                            <input type="hidden" name="customer_email" value="customer@example.com"> <!-- You can replace this with dynamic data from user authentication if needed -->

                            <div class="flex items-center space-x-4">
                                <input type="number" name="quantity" min="1" max="{{ $ticket->quantity }}" value="1" class="w-20 p-2 border rounded-md" required>
                                <p class="text-sm text-gray-500">Max available: {{ $ticket->quantity }}</p>
                            </div>
                            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Buy Ticket</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</div>
@endsection