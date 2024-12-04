<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Script tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Script Box Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <nav class="flex justify-between py-3 mx-16">
        <h1>Judul</h1>
        <ul class="flex gap-8">
            <li><a href="">Beranda</a></li>
            <li>
                <a href="" class="flex items-center justify-center">Event <i class="bx bx-chevron-down"></i></a>
            </li>
            <li>
                <a href="" class="flex items-center justify-center">Buat Event <i class="bx bx-chevron-down"></i></a>
            </li>
            <li>
                <a href="" class="flex items-center justify-center">Hubungi Kami <i class="bx bx-chevron-down"></i></a>
            </li>
        </ul>
        @if(Auth::check())
        <div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item">Hi {{ Auth::user()->name_user }}</li>
                        <li><a href="#" class="dropdown-item"><i class="bi bi-ticket"></i> Tiketku</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
        @else
        <!-- Jika pengguna belum login -->
        <a href="{{ route('login') }}"><button class="bg-blue-600 text-white px-2 py-1 rounded-md">Login</button></a>
        @endif
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