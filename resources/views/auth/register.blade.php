@extends('layouts.authLayout')

@section('title', 'Register - Tiket Aja')

@section('content')

<body class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; width: 100vw; background-image: url('{{ asset('assets/img/bglogin.jpg') }}'); background-size: cover; background-position: center;">
        <div class="card px-3 d-flex flex-row-reverse" style="width: 600px; background-color: rgba(250, 250, 250, 0.419); backdrop-filter: blur(10px); border: none; box-sizing: border-box;">
            <div class="card-body d-flex flex-column" style="width: 300px;">
                @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                @endif
                <h5 class="card-title text-center mb-3 mt-3">SIGN UP</h5>

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
                <div class="card-footer text-center d-flex align-items-center justify-content-center text-white mt-1 mb-0" style="border: none;">
                    <small style="color: white;">Have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></small>
            </div>
            </div>
            <div class="container d-flex align-items-center justify-content-center" style="width: 300px;">
                <div class="container d-flex justify-content-center flex-column">  
                    <button class="btn btn-outline-danger fs-7 btn-sm mb-3">
                        <i class="fab fa-google me-2"></i> Register with Google
                    </button>
                    
                    <button class="btn btn-outline-primary fs-7 btn-sm">
                        <i class="fab fa-facebook-f me-2"></i> Register with Facebook
                    </button>
                </div>
            </div>
        </div>
</body>
@endsection