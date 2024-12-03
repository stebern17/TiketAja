<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <nav class="flex justify-between py-3 mx-16">
        <h1>Judul</h1>
        <ul class="flex gap-8">
            <li><a href="">Beranda</a></li>
            <li><a href="">Event</a></li>
            <li><a href="">Buat Event</a></li>
            <li><a href="">Hubungi Kami</a></li>
        </ul>
        <a href="{{ route('login') }}"><button>Login</button></a>
    </nav>

    <main class="px-16 pt-3 pb-40 bg-slate-100">
        @yield('content')
    </main>

    <footer class="pt-5 pb-3 px-20 bg-blue-950">
        <div class="grid grid-cols-4 gap-7 px-8 pb-5 text-white">
            <div>
                <h1>Judul</h1>
                <p class="py-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit
                </p>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Necessitatibus, quo. Nemo sed repudiandae odit. Omnis sunt minus
                    tenetur dolorem consequatur dolores alias quos, a labore eaque totam
                    voluptatem perspiciatis repellendus.
                </p>
            </div>

            <div class="text-sm">
                <h2 class="mb-2 font-bold text-lg">Hubungi Kami</h2>
                <p>+628123456789 (Customer Support)</p>
                <p>+628123456789 (Partnership)</p>
                <p>0xKXf@example.com</p>
                <p>eratix.id</p>
            </div>

            <div>
                <h2 class="mb-2 font-bold text-lg">Metode Pembayaran</h2>
                <div class="grid grid-cols-2 gap-1">
                    <div class="bg-white h-16 rounded-md"></div>
                    <div class="bg-white h-16 rounded-md"></div>
                    <div class="bg-white h-16 rounded-md"></div>
                    <div class="bg-white h-16 rounded-md"></div>
                    <div class="bg-white h-16 rounded-md"></div>
                </div>
            </div>

            <div>
                <h3 class="mb-2 font-bold">Tautan</h3>
                <ul>
                    <li class="list-disc ml-5"><a href="#">Tentang Kami</a></li>
                    <li class="list-disc ml-5"><a href="#">Syarat dan Ketentuan</a></li>
                    <li class="list-disc ml-5"><a href="#">Kebijakan Privasi</a></li>
                </ul>
                <h3 class="mb-2 mt-2 font-bold">Tautan</h3>
                <ul>
                    <li class="list-disc ml-5"><a href="#">Tentang Kami</a></li>
                    <li class="list-disc ml-5"><a href="#">Syarat dan Ketentuan</a></li>
                    <li class="list-disc ml-5"><a href="#">Kebijakan Privasi</a></li>
                </ul>
                <h3 class="mb-2 mt-2 font-bold">Tautan</h3>
                <ul>
                    <li class="list-disc ml-5"><a href="#">Tentang Kami</a></li>
                    <li class="list-disc ml-5"><a href="#">Syarat dan Ketentuan</a></li>
                    <li class="list-disc ml-5"><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
        <hr class="text-white" />
        <p class="text-center mt-3 text-white">
            &copy; 2024 Nama Perusahaan. Hak Cipta Dilindungi.
        </p>
    </footer>
</body>

</html>