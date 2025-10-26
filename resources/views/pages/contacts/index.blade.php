@extends('layouts.app')

@section('title', 'Liên hệ - Game Store')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Liên hệ với chúng tôi</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card bg-dark text-light">
                <div class="card-body">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="5">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-paper-plane"></i> Gửi liên hệ
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="row mt-5">
                <div class="col-md-4 text-center mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-3x text-danger mb-3"></i>
                            <h5>Địa chỉ</h5>
                            <p>123 Đường ABC, Quận XYZ, TP. HCM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-phone fa-3x text-danger mb-3"></i>
                            <h5>Điện thoại</h5>
                            <p>0123 456 789</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-3x text-danger mb-3"></i>
                            <h5>Email</h5>
                            <p>info@gamestore.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


