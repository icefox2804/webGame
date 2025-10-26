@extends('layouts.app')

@section('title', 'Thanh Toán - Game Store')

@section('content')
<div class="container my-5">
    <h2 class="text-white mb-4">
        <i class="fas fa-credit-card"></i> Thanh Toán
    </h2>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('cart.processCheckout') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Thông tin khách hàng -->
            <div class="col-lg-8">
                <div class="card bg-dark border-secondary mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user"></i> Thông Tin Khách Hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-white">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-white">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-white">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-white">Địa chỉ <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                          rows="3">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-white">Ghi chú</label>
                                <textarea name="note" class="form-control" rows="3" 
                                          placeholder="Ghi chú thêm về đơn hàng...">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phương thức thanh toán -->
                <div class="card bg-dark border-secondary">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-money-bill-wave"></i> Phương Thức Thanh Toán
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Chuyển khoản ngân hàng -->
                        <div class="form-check mb-3 p-3 border border-secondary rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" 
                                   value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                            <label class="form-check-label text-white w-100" for="bank_transfer">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-university fa-2x text-primary me-3"></i>
                                    <div>
                                        <strong>Chuyển khoản ngân hàng</strong>
                                        <p class="mb-0 text-white-50 small">Chuyển khoản qua ngân hàng</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Ví MoMo -->
                        <div class="form-check p-3 border border-secondary rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="momo" 
                                   value="momo" {{ old('payment_method') == 'momo' ? 'checked' : '' }}>
                            <label class="form-check-label text-white w-100" for="momo">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-mobile-alt fa-2x text-danger me-3"></i>
                                    <div>
                                        <strong>Ví MoMo</strong>
                                        <p class="mb-0 text-white-50 small">Thanh toán qua ví điện tử MoMo</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        @error('payment_method')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="col-lg-4">
                <div class="card bg-dark border-danger sticky-top" style="top: 20px;">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-clipboard-list"></i> Đơn Hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Danh sách sản phẩm -->
                        <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                            @foreach($cart as $id => $item)
                            <div class="d-flex mb-3 pb-3 border-bottom border-secondary">
                                @if($item['image'])
                                    <img src="{{ asset('images/' . $item['image']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="rounded me-2"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="text-white mb-1 small">{{ Str::limit($item['name'], 30) }}</h6>
                                    <p class="mb-0 text-white-50 small">
                                        {{ number_format($item['price'], 0, ',', '.') }}đ x {{ $item['quantity'] }}
                                    </p>
                                </div>
                                <div class="text-end">
                                    <span class="text-success fw-bold small">
                                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Tổng tiền -->
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-white-50">Tạm tính:</span>
                            <span class="text-white">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-white-50">Phí vận chuyển:</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        <hr class="border-secondary">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="text-white">Tổng cộng:</h5>
                            <h5 class="text-danger fw-bold">{{ number_format($total, 0, ',', '.') }}đ</h5>
                        </div>

                        <!-- Nút đặt hàng -->
                        <button type="submit" class="btn btn-danger w-100 mb-2">
                            <i class="fas fa-check-circle"></i> Đặt Hàng
                        </button>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
                        </a>

                        <div class="text-center mt-3">
                            <small class="text-white-50">
                                <i class="fas fa-shield-alt"></i> Thông tin được bảo mật
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
.form-control {
    background-color: #1a1a1a;
    border-color: #333;
    color: #fff;
}

.form-control:focus {
    background-color: #1a1a1a;
    border-color: #ff0044;
    color: #fff;
    box-shadow: 0 0 0 0.2rem rgba(255, 0, 68, 0.25);
}

.form-check-input:checked {
    background-color: #ff0044;
    border-color: #ff0044;
}

.form-check-input:focus {
    border-color: #ff0044;
    box-shadow: 0 0 0 0.2rem rgba(255, 0, 68, 0.25);
}

.form-check-label:hover {
    background-color: rgba(255, 0, 68, 0.1);
    cursor: pointer;
}
</style>
@endsection

