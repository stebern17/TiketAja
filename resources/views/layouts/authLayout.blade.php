<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link rel="icon" href="{{ asset('assets/img/tikettt.png') }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
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
            background-color: #4caf50; /* Green */
        }
        #notification.error {
            background-color: #f44336; /* Red */
        }
    </style>
</head>

<div id="notification"></div>

<body class="bg-login max">
    <div class="container">
        <div class="min-vh-100 d-flex align-items-center justify-content-center">
            @yield('content')
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts.js"></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const notification = document.getElementById('notification');

        let message = '';
        let type = '';

        @if (session('status') === 'success')
            message = "Login berhasil! Selamat datang di halaman katalog.";
            type = 'success';
        @elseif (session('status') === 'error')
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
            } else if (type === 'error') {
                notification.style.backgroundColor = '#f44336'; // Red for error
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


</html>
