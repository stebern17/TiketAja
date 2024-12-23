@extends('layouts.authLayout')

@section('title', 'Login')

@section('content')


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
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-grup mb-3">
                <label for="email" class="form-label">Email / Username</label>
                <input type="email" class="form-control" id="email_user" name="email_user" required autofocus>
            </div>
            <div class="form-grup mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <a href="{{ route('register') }}">Doesn't have account?</a>
        </form>
    </div>
</div>


@endsection