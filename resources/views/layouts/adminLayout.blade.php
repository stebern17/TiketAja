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

    <style>
        /* General Styles */
        body {
            background-color: #EDF2F7;
        }

        .navbar {
            background-color: white;
            /* Dark Slate Gray */
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
            color: cadetblue;
        }


        .navbar-nav .nav-link {
            color: cadetblue;
        }

        .navbar-nav .nav-link:hover {
            color: cadetblue;
            /* Light Grayish Blue */
        }

        .navbar .nav-item {
            color: cadetblue;
        }

        /* Sidebar */
        .sidebar {
            background-color: #F0FFFF;
            /* Cadet Blue */
            font-weight: bold;
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: #008B8B;
            font-size: 1rem;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: cadetblue;
            color: white;
            padding-left: 20px;
        }

        /* card */
        .card-header {
            background-color: cadetblue;
            border-radius: 10px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* button dgrid */
        .btn-ticket {
            background-color: cadetblue;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-back {
            background-color: cadetblue;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* card */
        .card-header {
            background-color: cadetblue;
            border-radius: 10px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* button dgrid */
        .btn-ticket {
            background-color: cadetblue;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-back {
            background-color: cadetblue;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Main Content */
        .main-content {
            padding: 20px;
            background-color: #eff5f5;
            /* Light Grayish Blue */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1.1rem;
        }

        .table tr th {
            background-color: #5F9EA0;
            padding: 12px 15px;
            color: white
        }

        /* Styling for the pagination container */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        /* Styling for individual pagination links */
        .pagination .page-item {
            margin: 0 5px;
        }

        /* Styling for the page link */
        .pagination .page-link {
            padding: 8px 15px;
            background-color: #fff;
            color: #5F9EA0;
            /* Custom color for page links */
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Hover effect for page links */
        .pagination .page-link:hover {
            background-color: #5F9EA0;
            /* Background color on hover */
            color: #fff;
            /* Text color on hover */
        }

        /* Active page styling */
        .pagination .page-item.active .page-link {
            background-color: #5F9EA0;
            /* Active page background */
            color: #fff;
            /* Active page text color */
            border: 1px solid #5F9EA0;
        }

        /* Disable page link styling */
        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            color: #6c757d;
            pointer-events: none;
            cursor: not-allowed;
        }

        /* Styling for the previous and next buttons */
        .pagination .page-item .page-link {
            font-size: 16px;
            padding: 8px 12px;
        }

        /* Optional: Styling for ellipsis (if any) */
        .pagination .page-item.disabled .page-link {
            background-color: transparent;
        }

        /* Button */
        .btn-primary {
            background-color: #48BB78;
            /* Emerald Green */
            border-color: #48BB78;
        }

        .btn-primary:hover {
            background-color: #38A169;
            /* Darker Emerald Green */
            border-color: #38A169;
        }

        .btn-warning {
            background-color: #F6AD55;
            /* Orange */
            border-color: #F6AD55;
        }

        .btn-warning:hover {
            background-color: #DD6B20;
            /* Darker Orange */
            border-color: #DD6B20;
        }

        #notification {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 9999;
            display: none;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            max-width: 400px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            color: #fff;
            transition: all 0.5s ease;
        }

        #notification.success {
            background-color: #4caf50;
            /* Green */
        }


        /* Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 1000;
                height: 100%;
                width: 250px;
                left: -250px;
                transition: 0.3s;
            }

            .sidebar.show {
                left: 0;
            }

            #sidebarToggle {
                display: inline-block;
            }

            .main-content {
                margin-left: 0;
                padding-top: 70px;
            }
        }

        /* Toggle Sidebar Button */
        #sidebarToggle {
            background-color: #80b1b3;
            border: none;
            color: white;
            font-size: 1.3rem;
            padding: 8px 12px;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        #sidebarToggle:hover {
            background-color: #3b6978;
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="navbar-brand fs-3">Admin Dashboard</h1>

                <button class="btn btn-primary" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">Hi {{ Auth::user()->name_user }}</li>
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
    <div id="notification"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar" id="sidebar">
                <div class="d-flex flex-column p-3 text-white">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link fs-6 mb-2"
                                href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  fs-6 mb-2" href="{{ route('users.index') }}"><i class="bi bi-people-fill me-2"></i>User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 mb-2" href="{{ route('events.index') }}"><i class="bi bi-calendar2-event me-2"></i>Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 mb-2" href="{{ route('events.create') }}"><i class="bi bi-pencil-square me-2"></i>Create
                                Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 mb-2" href="{{ route('admin.orders.index') }}"><i class="bi bi-list-ul me-2"></i>Manage
                                Order</a>
                        </li>
                        <li>
                            <a class="nav-link fs-6" href="{{ route('admin.ticketValidation') }}"><i class="bi bi-ticket-perforated me-2"></i>
                                Ticket Validation
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 mx-auto main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    {{-- <footer>
        <p>&copy; 2024 Your Company. All rights reserved.</p>
    </footer> --}}

    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
    </script>

    {{-- status --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const notification = document.getElementById('notification');

            let message = '';
            let type = '';

            @if(session('status') === 'success')
            message = "Login berhasil!";
            type = 'success';
            @else
            if (session('status') === 'logout')
                message = "Email atau password salah!";
            type = 'error';
            @endif

            if (message) {
                showNotification(message, type);
            }

            function showNotification(message, type) {
                notification.style.display = 'block';
                notification.style.transition = 'all 0.5s ease';
                notification.textContent = message;

                if (type === 'success') {
                    notification.style.backgroundColor = '#4caf50'; // Green for success
                }

                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.style.display = 'none';
                        notification.style.opacity = '1';
                    }, 400);
                }, 4000);
            }
        });
    </script>
</body>

</html>