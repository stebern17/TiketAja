<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid d-flex">
            <div>
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <button class="btn btn-primary" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>

            </div>
            <div>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
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
                            <a class="nav-link text-white-50 fs-5 mb-5" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50 fs-5 mb-2" href="{{ route('events.index') }}">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50 fs-5 mb-2" href="{{ route('events.create') }}">Create Event</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
