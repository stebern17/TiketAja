<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid d-flex">
            <!-- Kiri: Brand & Sidebar Toggle -->
            <div>
                <div>
                    <a class="navbar-brand" href="#">Admin Dashboard</a>
                    <button class="btn btn-primary" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <!-- Kanan: Dropdown User Settings -->
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <!-- Dropdown Menu for User Settings -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <!-- User Icon -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">Hi {{ Auth::user()->name_user }}</li>
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
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-dark sidebar">
                <div class="d-flex flex-column p-3 text-white">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white-50 fs-5 mb-5"
                                href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50 fs-5 mb-2" href="{{ route('users.index') }}"><i class="bi bi-people-fill me-2"></i>User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50 fs-5 mb-2" href="{{ route('events.index') }}"><i class="bi bi-calendar2-event me-2"></i>Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50 fs-5 mb-2" href="{{ route('events.create') }}"><i class="bi bi-pencil-square me-2"></i>Create
                                Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50 fs-5 mb-2" href="{{ route('admin.orders.index') }}"><i class="bi bi-list-ul me-2"></i>Manage
                                Order</a>

                        </li>
                        <li>
                            <a class="nav-link text-white-50 fs-5" href="{{ route('admin.ticketValidation') }}"><i class="bi bi-ticket-perforated me-2"></i>
                                Ticket Validation
                            </a>

                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 mx-auto">
                @yield('content')

            </div>
        </div>
    </div>
</body>

</html>