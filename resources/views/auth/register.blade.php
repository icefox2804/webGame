@extends('layouts.app')

@section('title', 'Register ')



@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card bg-dark border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-3x text-danger mb-3"></i>
                        <h2 class="text-white text-uppercase" style="letter-spacing: 2px;">Đăng Ký</h2>
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

                        <form method="POST" action="{{ route('auth.register.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label text-white">
                                    <i class="fas fa-user me-2"></i>Họ và Tên
                                </label>
                                <input type="text" 
                                       class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-white">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" 
                                       class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}">
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
                                <small class="text-white-50">Tối thiểu 8 ký tự</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-white">
                                    <i class="fas fa-lock me-2"></i>Nhập Lại Mật Khẩu
                                </label>
                                <input type="password" 
                                       class="form-control bg-dark text-white border-secondary" 
                                       id="password_confirmation" 
                                       name="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold text-uppercase" style="letter-spacing: 1px;">
                                <i class="fas fa-user-plus me-2"></i>Đăng ký
                            </button>
                        </form>

                        <hr class="my-4 border-secondary">

                        <div class="text-center">
                            <p class="text-light opacity-75 mb-2">Đã có tài khoản?</p>
                            <a href="{{ route('auth.login') }}" class="btn btn-outline-danger w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập ngay
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