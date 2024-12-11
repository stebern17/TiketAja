@extends('layouts.userLayout')

@section('title', 'Tiket Aja - Home Page')

@section('content')
<!-- Carousel -->
<div class="relative w-full">
    <!-- Images Container -->
    <div class="relative">
        <img src="{{ asset('images/user/1.jpg') }}" alt="Carousel 1"
            class="h-96 w-full object-cover active carousel-img">
        <img src="{{ asset('images/user/2.jpg') }}" alt="Carousel 2"
            class="h-96 w-full object-cover hidden carousel-img">
        <img src="{{ asset('images/user/1.jpg') }}" alt="Carousel 3"
            class="h-96 w-full object-cover hidden carousel-img">
        <img src="{{ asset('images/user/2.jpg') }}" alt="Carousel 4"
            class="h-96 w-full object-cover hidden carousel-img">
    </div>

    <!-- previous button -->
    <button id="prevBtn"
        class="absolute flex top-1/2 -left-4 text-3xl bg-white px-2 py-1 rounded-full hover:opacity-80">
        <i class='bx bxs-chevron-left text-sm text-slate-400 self-center justify-center'></i>
    </button>

    <!-- next button -->
    <button id="nextBtn"
        class="absolute flex top-1/2 -right-4 text-3xl bg-white px-2 py-1 rounded-full hover:opacity-80">
        <i class='bx bxs-chevron-right text-sm text-slate-400 self-center justify-center'></i>
    </button>

    <div id="carouselIndicators" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
        <span class="indicator-dot h-2 w-2 rounded-full bg-gray-400"></span>
        <span class="indicator-dot h-2 w-2 rounded-full bg-gray-400"></span>
        <span class="indicator-dot h-2 w-2 rounded-full bg-gray-400"></span>
        <span class="indicator-dot h-2 w-2 rounded-full bg-gray-400"></span>
    </div>
</div>

<!-- Search -->
<div class="mt-3">
    <form class="grid grid-cols-6 gap-3 text-sm">
        <input type="text" placeholder="Cari Event Disini..."
            class="col-span-5 outline-none border-2 border-blue-800 py-2 px-3 rounded-xl shadow-md" />
        <button
            class="flex items-center gap-2 justify-center col-span-1 bg-blue-800 text-white py-2 rounded-xl hover:opacity-80">
            <i class="bx bx-search text-xl"></i> Cari Event
        </button>
    </form>
</div>

<!-- tag -->
<div class="flex mt-3 gap-2">
    <button
        class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
        <i class='bx bxs-music text-blue-500'></i> Konser
    </button>
    <button
        class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
        <i class='bx bxs-party text-blue-500'></i>Seminar & Workshop
    </button>
    <button
        class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
        <i class='bx bx-globe text-blue-500'></i>Pameran
    </button>
    <button
        class="flex items-center gap-2 py-2 px-2 bg-white rounded-md text-sm text-blue-800 font-semibold shadow-md hover:opacity-80">
        <i class='bx bx-dialpad text-blue-500'></i>Lainnya
    </button>
</div>

<!-- Card -->
<div class="mt-4 relative">
    <button class="bg-blue-800 text-white px-2 py-1 font-semibold rounded-md hover:opacity-80">
        Event Terdekat
    </button>
    <div class="grid grid-cols-5 gap-3 mt-3">
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
                <a href="{{ route('user.catalogue.showEvent', $event->id_event) }}" class="bg-blue-300 text-blue-800 px-3 rounded-full text-xs hover:opacity-80">
                    Lainnya
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<button
    class="bg-blue-800 text-white px-5 py-2 font-semibold rounded-md mt-3 absolute left-1/2 -translate-x-1/2 hover:opacity-80">
    Lihat semua event
</button>
</div>


<!-- Banner -->
<div class="container bg-warning p-3 rounded banner">
    <div class="container text-center">
        <b class="fs-3 fw-bolder d-block mb-3">Event yang dipilih khusus untuk Anda!</b>
        <p class="fs-6 mb-4 fw-medium">Dapatkan saran acara yang disesuaikan dengan minat Anda! Jangan sampai acara favorit Anda terlewatkan.</p>

        <a href="#" class="btn btn-outline-danger">
            Get Started
        </a>
    </div>
</div>


<script>
    // Variables
    const images = document.querySelectorAll('.carousel-img');
    const dots = document.querySelectorAll('.indicator-dot'); // Ambil semua indikator
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    let currentIndex = 0;

    // Function to update visibility and dots
    const updateCarousel = () => {
        images.forEach((image, index) => {
            if (index === currentIndex) {
                image.classList.remove('hidden'); // Tampilkan gambar
            } else {
                image.classList.add('hidden'); // Sembunyikan gambar
            }
        });

        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('bg-blue-500'); // Tandai indikator aktif dengan warna biru
                dot.classList.remove('bg-gray-400'); // Hapus warna default
            } else {
                dot.classList.add('bg-gray-400'); // Kembalikan warna default
                dot.classList.remove('bg-blue-500'); // Hapus warna aktif
            }
        });
    };

    // Event Listeners
    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
        updateCarousel();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
        updateCarousel();
    });

    // Initialize Carousel
    updateCarousel();
</script>
@endsection