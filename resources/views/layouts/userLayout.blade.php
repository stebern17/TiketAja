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
        <button>Login</button>
    </nav>

    <main class="px-16 pt-3 pb-40 bg-slate-100">
        @yield('content')
    </main>
</body>

</html>