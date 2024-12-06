@extends('layouts.authLayout')

@section('title', 'Register - Tiket Aja')

@section('content')

<body class="container-fluid d-flex justify-content-center align-items-center bg-login">
    <div class="card px-3 card-login">
        <div class="card-body d-flex flex-column">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <h5 class="card-title text-center mb-3">REGISTER</h5>

            <form method="POST" action="{{ route('register') }}">
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
            </form>
        </div>
        <div class="card-footer text-center d-flex align-items-center justify-content-center text-white" style="border: none;">
            <small style="color: white;">Have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></small>
        </div>
    </div>
</body>
@endsection