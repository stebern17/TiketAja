@extends('layouts.authLayout')

@section('title', 'Login')

@section('content')

<body class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100vw; background-image: url('{{ asset('assets/img/bglogin.jpg') }}'); background-size: cover; background-position: center;">
        <div class="card px-3 py-3" style="width: 300px; background-color: rgba(250, 250, 250, 0.419); backdrop-filter: blur(10px); border: none; box-sizing: border-box;">
            <div class="card-body d-flex flex-column">
                @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                <h5 class="card-title text-center mb-4">LOGIN</h5>

                <div class="d-flex justify-content-between mb-3">
                    <!-- Button untuk Login dengan Google -->
                    <button class="btn btn-outline-danger flex-fill me-2 fs-7 btn-sm">
                        <i class="fab fa-google"></i> Login with Google
                    </button>
                    <!-- Button untuk Login dengan Facebook -->
                    <button class="btn btn-outline-primary flex-fill ms-2 fs-7 btn-sm">
                        <i class="fab fa-facebook-f"></i> Login with Facebook
                    </button>
                </div>

                <div class="line-container" style="display: flex; justify-content: center; align-items: center; text-align: center; margin: 20px 0;">
                    <span class="line-text">OR</span>
                </div>

                <form method="POST" action="{{ route('login') }}" >
                    <div class="form-grup mb-3">
                        <label for="email" class="form-label">Email / Username</label>
                        <input type="email" class="form-control" id="email_user" name="email_user" required autofocus>
                    </div>
                    <div class="form-grup mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="card-footer text-center d-flex align-items-center justify-content-center text-white" style="border: none;">
                <small style="color: white;">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a></small>
            </div>
        </div>
</body>
@endsection