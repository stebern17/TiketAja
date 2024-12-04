@extends('layouts.userLayout')

@section('title', 'Tiketku')

@section('content')
<!-- Carousel -->
<div class="flex justify-center relative">
    <img src="{{ asset('images/user/1.jpg') }}" alt="First Image" class="bg-cover h-96 w-full" />
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
        <div class="bg-white shadow-lg p-3 rounded-md">
            <img src="{{ asset('images/user/2.jpg') }}" alt="img-card" class="w-full h-20 rounded-sm" />
            <h2 class="font-semibold text-blue-700 text-sm my-2">
                Merumatta Half Marathon
            </h2>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bxs-calendar text-base text-blue-800"></i> Minggu, 8
                Des 2024
            </p>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bx-current-location text-base text-blue-800"></i>
                Kab. Lombok Barat, Nusa Tenggara Barat
            </p>
            <p class="text-xs text-blue-800 font-semibold">Mulai dari</p>
            <div class="flex justify-between">
                <p class="text-orange-500 font-bold text-sm">Rp275,000</p>
                <button class="bg-blue-300 text-blue-800 px-3 rounded-full text-xs hover:opacity-80">
                    Lainnya
                </button>
            </div>
        </div>
        <div class="bg-white shadow-lg p-3 rounded-md">
            <img src="{{ asset('images/user/2.jpg') }}" alt="img-card" class="w-full h-20 rounded-sm" />
            <h2 class="font-semibold text-blue-700 text-sm my-2">
                Merumatta Half Marathon
            </h2>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bxs-calendar text-base text-blue-800"></i> Minggu, 8
                Des 2024
            </p>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bx-current-location text-base text-blue-800"></i>
                Kab. Lombok Barat, Nusa Tenggara Barat
            </p>
            <p class="text-xs text-blue-800 font-semibold">Mulai dari</p>
            <div class="flex justify-between">
                <p class="text-orange-500 font-bold text-sm">Rp275,000</p>
                <button class="bg-blue-300 text-blue-800 px-3 rounded-full text-xs hover:opacity-80">
                    Lainnya
                </button>
            </div>
        </div>
        <div class="bg-white shadow-lg p-3 rounded-md">
            <img src="{{ asset('images/user/2.jpg') }}" alt="img-card" class="w-full h-20 rounded-sm" />
            <h2 class="font-semibold text-blue-700 text-sm my-2">
                Merumatta Half Marathon
            </h2>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bxs-calendar text-base text-blue-800"></i> Minggu, 8
                Des 2024
            </p>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bx-current-location text-base text-blue-800"></i>
                Kab. Lombok Barat, Nusa Tenggara Barat
            </p>
            <p class="text-xs text-blue-800 font-semibold">Mulai dari</p>
            <div class="flex justify-between">
                <p class="text-orange-500 font-bold text-sm">Rp275,000</p>
                <button class="bg-blue-300 text-blue-800 px-3 rounded-full text-xs hover:opacity-80">
                    Lainnya
                </button>
            </div>
        </div>
        <div class="bg-white shadow-lg p-3 rounded-md">
            <img src="{{ asset('images/user/2.jpg') }}" alt="img-card" class="w-full h-20 rounded-sm" />
            <h2 class="font-semibold text-blue-700 text-sm my-2">
                Merumatta Half Marathon
            </h2>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bxs-calendar text-base text-blue-800"></i> Minggu, 8
                Des 2024
            </p>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bx-current-location text-base text-blue-800"></i>
                Kab. Lombok Barat, Nusa Tenggara Barat
            </p>
            <p class="text-xs text-blue-800 font-semibold">Mulai dari</p>
            <div class="flex justify-between">
                <p class="text-orange-500 font-bold text-sm">Rp275,000</p>
                <button class="bg-blue-300 text-blue-800 px-3 rounded-full text-xs hover:opacity-80">
                    Lainnya
                </button>
            </div>
        </div>
        <div class="bg-white shadow-lg p-3 rounded-md">
            <img src="{{ asset('images/user/2.jpg') }}" alt="img-card" class="w-full h-20 rounded-sm" />
            <h2 class="font-semibold text-blue-700 text-sm my-2">
                Merumatta Half Marathon
            </h2>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bxs-calendar text-base text-blue-800"></i> Minggu, 8
                Des 2024
            </p>
            <p class="flex items-center gap-1 text-xs text-slate-500 mb-2">
                <i class="bx bx-current-location text-base text-blue-800"></i>
                Kab. Lombok Barat, Nusa Tenggara Barat
            </p>
            <p class="text-xs text-blue-800 font-semibold">Mulai dari</p>
            <div class="flex justify-between">
                <p class="text-orange-500 font-bold text-sm">Rp275,000</p>
                <button class="bg-blue-300 text-blue-800 px-3 rounded-full text-xs hover:opacity-80">
                    Lainnya
                </button>
            </div>
        </div>

    </div>
    <button
        class="bg-blue-800 text-white px-5 py-2 font-semibold rounded-md mt-3 absolute left-1/2 -translate-x-1/2 hover:opacity-80">
        Lihat semua event
    </button>
</div>

@endsection