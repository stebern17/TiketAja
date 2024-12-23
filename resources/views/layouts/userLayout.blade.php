<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('assets/img/tikettt.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Script tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Ensure Popper.js is loaded before Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <style>
        .dropdown-menu {
            display: none;
        }

        .show {
            display: block !important;
        }

        #navbar {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(0px);
            transition: background-color 0.3s, backdrop-filter 0.3s;
        }

        .scrolled {
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
        }
    </style>
</head>


<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav id="navbar"
        class="w-100 ms-0 d-flex justify-content-between px-5 py-3 mx-4 align-items-center position-sticky top-0 z-50  transition-all">
        <div class="brand-logo d-flex">
            <img src="{{ asset('assets/img/tikettt.png') }}" style="width: 50px;" class="me-1" alt="Tiket Aja">
            <a class="navbar-brand fw-bold fs-2" href="{{ route('catalogue.index')}}">Tiket Aja</a>
        </div>
        <ul class="d-flex gap-3 align-items-center mb-0">
            <li><a href="{{ route('catalogue.index')}}" class="text-decoration-none text-dark">Beranda</a></li>
            <!-- Dropdown Event -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Event <i class="bx bx-chevron-down"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    <li class="dropdown-item"><a href="#" class="nav-link text-dark">Acara Hiburan</a></li>
                    <li class="dropdown-item"><a href="#" class="nav-link text-dark">Acara Olahraga</a></li>
                    <li class="dropdown-item"><a href="#" class="nav-link text-dark">Acara Pendidikan</a></li>
                    <li class="dropdown-item"><a href="#" class="nav-link text-dark">Lainya</a></li>
                </ul>
            </li>
            <li><a href="#" class="text-decoration-none text-dark">Hubungi Kami</a></li>
        </ul>
        @if(Auth::check())
        <div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item">Hi {{ Auth::user()->name_user }}</li>
                        <li><a href="{{route('order.index')}}" class="dropdown-item"><i class="bi bi-ticket"></i> Tiketku</a></li>
                        <li><a href="{{route('user.settings')}}" class="dropdown-item"><i class="bi bi-gear"></i> Settings</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
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
        <a href="{{ route('login') }}"><button class="btn btn-outline-primary rounded-pill px-4">LOGIN</button></a>
        @endif
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 px-16 pt-3 pb-3 bg-slate-100">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Tiket Aja</h5>
                    <p>Tiket Aja adalah platform penjualan tiket terpercaya untuk berbagai acara seperti konser, olahraga, seminar, dan lainnya. Dapatkan tiket dengan mudah, cepat, dan aman hanya di Tiket Aja!</p>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-whatsapp"></i> +6285179787955 (Customer Support)</li>
                        <li><i class="bi bi-whatsapp"></i> +6281919004243 (Partnership)</li>
                        <li><i class="bi bi-instagram"></i> tiketaja.id</li>
                        <li><i class="bi bi-envelope"></i> contact@tiketaja.id</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Metode Pembayaran</h5>
                    <div class="row row-cols-3 g-2">
                        <div class="col"><img src="{{ asset('assets/img/11.png') }}" alt="QRIS" class="img-fluid rounded-2"></div>
                        <div class="col"><img src="{{ asset('assets/img/1.png') }}" alt="Bank BRI" class="img-fluid rounded-2"></div>
                        <div class="col"><img src="{{ asset('assets/img/3.png') }}" alt="BNI" class="img-fluid rounded-2"></div>
                        <div class="col"><img src="{{ asset('assets/img/2.png') }}" alt="Mandiri" class="img-fluid rounded-2"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Tautan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Syarat dan Ketentuan</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center py-3">
            &copy; 2024 Tiket Aja Corp - All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>



    <!--NavBar Scrool-->
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {

                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    <script>
        var dropdown = new bootstrap.Dropdown(document.getElementById('eventSports'));
    </script>



</body>

</html>