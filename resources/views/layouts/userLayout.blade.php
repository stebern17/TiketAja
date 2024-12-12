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


<body>
    <nav id="navbar" class="w-100 ms-0 d-flex justify-content-between px-5 py-3 mx-4 align-items-center position-sticky top-0 z-50  transition-all">
        <div class="brand-logo d-flex">
            <img src="{{ asset('assets/img/tikettt.png') }}" style="width: 50px;" class="me-1" alt="Tiket Aja">
            <a class="navbar-brand fw-bold fs-2" href="{{ route('catalogue.index')}}">Tiket Aja</a>
        </div>
        <ul class="d-flex gap-3 align-items-center mb-0">
            <li><a href="{{ route('catalogue.index')}}" class=" text-decoration-none text-dark">Beranda</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link text-dark" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Event <i class="bx bx-chevron-down"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    <!-- Kategori Acara Hiburan -->
                    <li class="dropdown-item">
                        <a class="nav-link text-dark" href="#" id="eventEntertainment" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acara Hiburan
                        </a>
                    </li>
                    <!-- Kategori Acara Olahraga -->
                    <li class="dropdown-item">
                        <a class="nav-link text-dark" href="#" id="eventSports" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acara Olahraga
                        </a>
                    </li>
                    <!-- Kategori Acara Pendidikan -->
                    <li class="dropdown-item">
                        <a class="nav-link text-dark" href="#" id="eventEducation" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acara Pendidikan
                        </a>

                    </li>
                    <!-- Kategori Lainnya -->
                    <li class="dropdown-item">
                        <a class="nav-link text-dark" href="#" id="lainya" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Lainya
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="" class="flex items-center justify-center text-decoration-none text-dark">Hubungi Kami <i class="bx bx-chevron-down"></i></a>
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
                        <li><a href="{{route('order.index')}}" class="dropdown-item"><i class="bi bi-ticket"></i> Tiketku</a></li>
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
        <a href="{{ route('login') }}"><button class="btn btn-outline-primary rounded-pill px-4">LOGIN</button></a>
        @endif
    </nav>



    <main class="px-16 pt-3 pb-40 bg-slate-100">
        @yield('content')
    </main>

    <!--Footer-->
    <footer class="bg-dark text-white px-5 py-4">
        <div class="container-fluid d-flex justify-content-center gap-4">
            <div class="row align-items-start d-flex justify-content-center">
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Tiket Aja</h5>
                    <blockquote class="blockquote mb-3">
                        <p class="mb-0">"Murah, Cepat, Terpercaya"</p>
                    </blockquote>
                    <p>
                        Tiket Aja adalah platform penjualan tiket terpercaya untuk berbagai acara seperti konser, olahraga, seminar, dan lainnya.
                        Dapatkan tiket dengan mudah, cepat, dan aman hanya di Tiket Aja!
                    </p>
                </div>

                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none"><i class="bi bi-whatsapp"></i> +6285179787955 (Customer Support)</a></li>
                        <li><a href="#" class="text-white text-decoration-none"><i class="bi bi-whatsapp"></i> +6281919004243 (Partnership)</a></li>
                        <li><a href="#" class="text-white text-decoration-none"><i class="bi bi-instagram"></i> tiketaja.id</a></li>
                        <li><a href="#" class="text-white text-decoration-none"><i class="bi bi-envelope"></i> contact@tiketaja.id</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Metode Pembayaran</h5>
                    <div class="row row-cols-3">
                        <div class="col mb-1">
                            <img alt="QRIS" src="{{ asset('assets/img/11.png') }}" class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="Bank BRI" src={{ asset('assets/img/1.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="BNI" src={{ asset('assets/img/3.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="Mandiri" src={{ asset('assets/img/2.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="CIMB Niaga" src={{ asset('assets/img/4.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="BSI" src={{ asset('assets/img/6.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="PermataBank" src={{ asset('assets/img/5.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="DANA" src={{ asset('assets/img/10.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="OVO" src={{ asset('assets/img/9.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="ShopeePay" src={{ asset('assets/img/12.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="LinkAja" src={{ asset('assets/img/13.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="BCA" src={{ asset('assets/img/14.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="Alfamart" src={{ asset('assets/img/7.png') }} class="rounded-2" height="40">
                        </div>
                        <div class="col mb-1">
                            <img alt="Alfamidi" src={{ asset('assets/img/8.png') }} class="rounded-2" height="40">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <h5 class="fw-bold mb-3">Tautan</h5>
                        <ul>
                            <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Syarat dan Ketentuan</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-3">Akun Pembeli</h5>
                        <ul>
                            <li><a href="#" class="text-white text-decoration-none">Transaksi & Tiket Aja</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Syarat dan Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <hr class="border-light">
            <p class="text-center mt-3">&copy; 2024 Tiket Aja Corp - All Rights Reserved.</p>
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
