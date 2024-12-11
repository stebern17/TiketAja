@extends('layouts.authLayout')

@section('title', 'Register - Tiket Aja')

@section('content')

<body class="container-fluid d-flex justify-content-center align-items-center bg-login">
    <div class="card px-3 py-3 card-login">
        <div class="card-body d-flex flex-column">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="d-flex justify-center">
                <a href="{{ route('catalogue.index')}}"><i class="bi bi-arrow-left text-primary position-absolute"></i></a>
                <h5 class="card-title text-center mb-4 mx-auto">LOGIN</h5>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name_user" name="name_user" required>
                </div>
                <div class="form-group mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email_user" name="email_user" required autofocus>
                </div>
                <div class="form-group mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-2">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                <div>
                    <a href="{{ route('login') }}">Already had one?</a>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
