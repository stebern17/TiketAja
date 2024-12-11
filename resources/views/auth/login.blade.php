@extends('layouts.authLayout')

@section('title', 'Login - Tiket Aja')

@section('content')

<body class="container-fluid d-flex justify-content-center align-items-center bg-login">
    <div class="card px-3 py-3 card-login">
        <div class="card-body d-flex flex-column">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <h5 class="card-title text-center mb-4">LOGIN</h5>

            <div class="container d-flex justify-content-center mb-1 flex-column">

                <button class="btn btn-outline-danger fs-7 btn-sm mb-2">
                    <i class="fab fa-google me-2"></i> Login with Google
                </button>

                <button class="btn btn-outline-primary fs-7 btn-sm">
                    <i class="fab fa-facebook-f me-2"></i> Login with Facebook
                </button>
            </div>

            <div class="line-container" style="display: flex; justify-content: center; align-items: center; text-align: center; margin: 20px 0;">
                <span class="line-text">OR</span>
            </div>

            <form method="POST" action="{{ route('login') }}">
                <div class="form-grup mb-3">
                    <label for="email" class="form-label">Email / Username</label>
                    <input type="email" class="form-control" id="email_user" name="email_user" required autofocus>
                </div>
                <div class="form-grup mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-link bg-white" id="togglePassword">
                            <i class="fas fa-eye color-dark"></i>
                        </button>
                    </div>
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
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');

            // Toggle tipe input antara password dan text
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
@endsection