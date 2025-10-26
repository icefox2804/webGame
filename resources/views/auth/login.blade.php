@extends('layouts.app')

@section('title', 'Đăng nhập - Game Store')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card bg-dark border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-gamepad fa-3x text-danger mb-3"></i>
                        <h2 class="text-white text-uppercase" style="letter-spacing: 2px;">Đăng nhập</h2>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('auth.login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-white">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input type="email" 
                                   class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-white">
                                <i class="fas fa-lock me-2"></i>Mật khẩu
                            </label>
                            <input type="password" 
                                   class="form-control bg-dark text-white border-secondary @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label text-white" for="remember">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                        </button>
                        <span class="text-white opacity-50 small">
                            tài khoản demo: <br> 
                            user@gmail.com - mật khẩu: 123456<br> 
                            admin@gmail.com - mật khẩu: 123456</span>
                    </form>

                    <hr class="my-4 border-secondary">

                    <div class="text-center">
                        <p class="text-light opacity-75 mb-2">Chưa có tài khoản?</p>
                        <a href="{{ route('auth.register') }}" class="btn btn-outline-danger w-100 mb-3">
                            <i class="fas fa-user-plus me-2"></i>Đăng ký ngay
                        </a>
                        <a href="{{ route('home') }}" class="text-decoration-none text-white">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection