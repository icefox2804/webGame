@extends('layouts.app')

@section('title', 'Đặt Hàng Thành Công - Game Store')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Message -->
            <div class="text-center mb-5">
                <div class="success-icon mb-4">
                    <i class="fas fa-check-circle fa-5x text-success"></i>
                </div>
                <h2 class="text-white mb-3">Đặt Hàng Thành Công!</h2>
                <p class="text-white-50 lead">Cảm ơn bạn đã mua hàng tại Game Store</p>
            </div>

            <!-- Order Info -->
            <div class="card bg-dark border-success mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i> Thông Tin Đơn Hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-white-50 mb-1">Mã đơn hàng:</p>
                            <p class="text-white fw-bold">{{ $order['order_id'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-white-50 mb-1">Ngày đặt:</p>
                            <p class="text-white fw-bold">{{ $order['created_at']->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    <hr class="border-secondary">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-white-50 mb-1">Họ tên:</p>
                            <p class="text-white">{{ $order['customer_name'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-white-50 mb-1">Email:</p>
                            <p class="text-white">{{ $order['email'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-white-50 mb-1">Số điện thoại:</p>
                            <p class="text-white">{{ $order['phone'] }}</p>
                        </div>
                        <div class="col-md-12">
                            <p class="text-white-50 mb-1">Địa chỉ:</p>
                            <p class="text-white">{{ $order['address'] }}</p>
                        </div>
                        @if($order['note'])
                        <div class="col-md-12">
                            <p class="text-white-50 mb-1">Ghi chú:</p>
                            <p class="text-white">{{ $order['note'] }}</p>
                        </div>
                        @endif
                    </div>

                    <hr class="border-secondary">

                    <div class="mb-3">
                        <p class="text-white-50 mb-1">Phương thức thanh toán:</p>
                        <p class="text-white">
                            @if($order['payment_method'] == 'bank_transfer')
                                <i class="fas fa-university text-primary"></i> Chuyển khoản ngân hàng
                            @elseif($order['payment_method'] == 'momo')
                                <i class="fas fa-mobile-alt text-danger"></i> Ví MoMo
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-box"></i> Sản Phẩm Đã Đặt
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order['items'] as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item['image'])
                                                <img src="{{ asset('images/' . $item['image']) }}" 
                                                     alt="{{ $item['name'] }}" 
                                                     class="rounded me-3"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <span class="text-white">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="text-white">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                                    <td class="text-white">{{ $item['quantity'] }}</td>
                                    <td class="text-success fw-bold">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end text-white fw-bold">Tổng cộng:</td>
                                    <td class="text-danger fw-bold fs-5">{{ number_format($order['total'], 0, ',', '.') }}đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Payment Instructions -->
            @if($order['payment_method'] == 'bank_transfer')
            <div class="card bg-dark border-info mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i> Hướng Dẫn Chuyển Khoản
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-white mb-3">Vui lòng chuyển khoản theo thông tin sau:</p>
                    <div class="bg-secondary p-3 rounded">
                        <p class="text-white mb-2"><strong>Ngân hàng:</strong> Vietcombank</p>
                        <p class="text-white mb-2"><strong>Số tài khoản:</strong> 0123456789</p>
                        <p class="text-white mb-2"><strong>Chủ tài khoản:</strong> GAME STORE</p>
                        <p class="text-white mb-2"><strong>Số tiền:</strong> <span class="text-danger fw-bold">{{ number_format($order['total'], 0, ',', '.') }}đ</span></p>
                        <p class="text-white mb-0"><strong>Nội dung:</strong> {{ $order['order_id'] }}</p>
                    </div>
                    <p class="text-warning mt-3 mb-0">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Lưu ý: Vui lòng ghi đúng nội dung chuyển khoản để chúng tôi xác nhận đơn hàng nhanh nhất.
                    </p>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-danger btn-lg me-2">
                    <i class="fas fa-home"></i> Về Trang Chủ
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-danger btn-lg">
                    <i class="fas fa-gamepad"></i> Tiếp Tục Mua Sắm
                </a>
            </div>

            <!-- Support Info -->
            <div class="alert alert-info bg-dark border-info mt-4">
                <h6 class="text-info">
                    <i class="fas fa-headset"></i> Hỗ Trợ Khách Hàng
                </h6>
                <p class="text-white-50 mb-0">
                    Nếu bạn có bất kỳ thắc mắc nào về đơn hàng, vui lòng liên hệ:
                    <br>
                    <strong class="text-white">Hotline:</strong> 1900-xxxx
                    <br>
                    <strong class="text-white">Email:</strong> support@gamestore.com
                </p>
            </div>
        </div>
    </div>
</div>

<style>
.success-icon {
    animation: scaleIn 0.5s ease-in-out;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.card {
    animation: slideUp 0.5s ease-in-out;
}

@keyframes slideUp {
    0% {
        transform: translateY(30px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

.table-dark {
    --bs-table-bg: transparent;
}

.table-dark th {
    border-bottom: 2px solid #ff0044;
    color: #fff;
}

.table-dark td {
    border-bottom: 1px solid #333;
}
</style>
@endsection

