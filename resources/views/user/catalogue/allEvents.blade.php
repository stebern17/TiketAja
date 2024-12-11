@extends('layouts.userLayout')

@section('content')
<div class="container">
    <!-- Search Bar -->
    <div class="mt-3">
        <!-- Pencarian -->
        <form action="{{ route('user.catalogue.showAllEvents') }}" method="GET" class="grid grid-cols-6 gap-3 text-sm">
            <!-- Input Pencarian -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Event Disini..."
                class="col-span-5 outline-none border-2 border-blue-800 py-2 px-3 rounded-xl shadow-md" />

            <!-- Tombol Cari -->
            <button type="submit"
                class="flex items-center gap-2 justify-center col-span-1 bg-blue-800 text-white py-2 rounded-xl hover:opacity-80">
                <i class="bx bx-search text-xl"></i> Cari Event
            </button>
        </form>
    </div>

    <!-- Filter Kategori -->
    <div class="flex mt-3 gap-2">
        <!-- Music -->
        <a href="{{ route('user.catalogue.showAllEvents', ['category' => 'Music', 'search' => request('search')]) }}"
            class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
            <i class="bx bxs-music text-blue-500"></i> Music
        </a>

        <!-- Sport -->
        <a href="{{ route('user.catalogue.showAllEvents', ['category' => 'Sport', 'search' => request('search')]) }}"
            class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
            <i class="bx bxs-football text-blue-500"></i> Sport
        </a>

        <!-- Seminar -->
        <a href="{{ route('user.catalogue.showAllEvents', ['category' => 'Seminar', 'search' => request('search')]) }}"
            class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
            <i class="bx bxs-calendar text-blue-500"></i> Seminar
        </a>

        <!-- Workshop -->
        <a href="{{ route('user.catalogue.showAllEvents', ['category' => 'Workshop', 'search' => request('search')]) }}"
            class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
            <i class="bx bxs-wrench text-blue-500"></i> Workshop
        </a>
    </div>



    <!-- Card -->
    <div class="mt-4 relative">
        <div class="grid grid-cols-4 gap-3 mt-3">
            @foreach($events as $event)
            <div class="bg-white shadow-lg p-3 rounded-md">
                <img src="{{ 'https://picsum.photos/200/300?random=' . rand(1, 1000) }}" alt="img-card" class="w-full h-20 rounded-sm object-cover" />
                <h2 class="font-semibold text-blue-700 text-sm my-2">
                    {{ $event->name }}
                </h2>
                <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                    <i class="bx bxs-calendar text-base text-blue-800"></i> {{ \Carbon\Carbon::parse($event->date)->format('l, d M Y') }}
                </p>
                <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                    <i class="bx bx-current-location text-base text-blue-800"></i>
                    {{ $event->location }}
                </p>
                <p class="text-xs text-blue-800 font-semibold">Mulai dari</p>
                <div class="flex justify-between">
                    @if($event->tickets->count() > 0)
                    <p class="text-orange-500 font-bold text-sm">Rp{{ number_format($event->tickets->first()->price ?? 0, 0, ',', '.') }}</p>
                    @else
                    <p class="text-orange-500 font-bold text-sm">Soldout</p>
                    @endif
                    <a href="{{ route('user.catalogue.showEvent', ['id_event' => $event->id_event]) }}" class="block mt-2 bg-blue-800 text-white py-2 px-4 rounded-md text-center font-semibold">Lihat Tiket</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        {{ $events->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection