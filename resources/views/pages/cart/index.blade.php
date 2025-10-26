@extends('layouts.app')

@section('title', 'Giỏ Hàng - Game Store')

@section('content')
<div class="container my-5">
    <h2 class="text-white mb-4">
        <i class="fas fa-shopping-cart"></i> Giỏ Hàng Của Bạn
    </h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="row">
            <!-- Danh sách sản phẩm -->
            <div class="col-lg-8">
                <div class="card bg-dark border-secondary">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item['image'])
                                                    <img src="{{ asset('images/' . $item['image']) }}" 
                                                         alt="{{ $item['name'] }}" 
                                                         class="rounded me-3"
                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                @else
                                                    <img src="https://via.placeholder.com/80" 
                                                         alt="{{ $item['name'] }}" 
                                                         class="rounded me-3">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0 text-white">{{ $item['name'] }}</h6>
                                                    @php
                                                        $product = App\Models\Product::find($id);
                                                    @endphp
                                                    @if($product && isset($product->stock))
                                                        @if($product->stock <= 0)
                                                            <small class="text-danger"><i class="fas fa-exclamation-circle"></i> Hết hàng</small>
                                                        @elseif($product->stock <= 5)
                                                            <small class="text-warning"><i class="fas fa-exclamation-triangle"></i> Chỉ còn {{ $product->stock }} sản phẩm</small>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-danger fw-bold">
                                                {{ number_format($item['price'], 0, ',', '.') }}đ
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @php
                                                $product = App\Models\Product::find($id);
                                                $maxStock = $product && isset($product->stock) ? $product->stock : 999;
                                                $isOutOfStock = $product && isset($product->stock) && $product->stock <= 0;
                                            @endphp
                                            <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <div class="input-group" style="width: 130px;">
                                                    <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            {{ $isOutOfStock ? 'disabled' : '' }}>
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="text" class="form-control form-control-sm text-center" 
                                                           value="{{ $item['quantity'] }}" readonly>
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" 
                                                            class="btn btn-sm btn-outline-success"
                                                            {{ ($item['quantity'] >= $maxStock || $isOutOfStock) ? 'disabled' : '' }}>
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-success fw-bold">
                                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')">
                                    <i class="fas fa-trash-alt"></i> Xóa toàn bộ
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tổng thanh toán -->
            <div class="col-lg-4">
                <div class="card bg-dark border-danger">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-file-invoice-dollar"></i> Tổng Đơn Hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-white-50">Tạm tính:</span>
                            <span class="text-white fw-bold">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-white-50">Phí vận chuyển:</span>
                            <span class="text-success fw-bold">Miễn phí</span>
                        </div>
                        <hr class="border-secondary">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="text-white">Tổng cộng:</h5>
                            <h5 class="text-danger fw-bold">{{ number_format($total, 0, ',', '.') }}đ</h5>
                        </div>
                        
                        <a href="{{ route('cart.checkout') }}" class="btn btn-danger w-100 mb-2">
                            <i class="fas fa-credit-card"></i> Thanh Toán
                        </a>
                        
                        <div class="text-center mt-3">
                            <small class="text-white-50">
                                <i class="fas fa-shield-alt"></i> Giao dịch được bảo mật
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Mã giảm giá -->
                <div class="card bg-dark border-secondary mt-3">
                    <div class="card-body">
                        <h6 class="text-white mb-3">
                            <i class="fas fa-tag"></i> Mã Giảm Giá
                        </h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                            <button class="btn btn-outline-success" type="button">
                                Áp dụng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Giỏ hàng trống -->
        <div class="text-center py-5">
            <div class="card bg-dark border-secondary">
                <div class="card-body py-5">
                    <i class="fas fa-shopping-cart fa-5x text-secondary mb-4"></i>
                    <h3 class="text-white mb-3">Giỏ Hàng Trống</h3>
                    <p class="text-white-50 mb-4">Bạn chưa có sản phẩm nào trong giỏ hàng</p>
                    <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg">
                        <i class="fas fa-gamepad"></i> Khám Phá Game
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .table-dark {
        --bs-table-bg: transparent;
    }
    
    .table-dark th {
        border-bottom: 2px solid #ff0044;
        color: #fff;
        font-weight: 600;
    }
    
    .table-dark td {
        vertical-align: middle;
        border-bottom: 1px solid #333;
    }
    
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    
    .input-group .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .form-control:focus {
        border-color: #ff0044;
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 68, 0.25);
    }
</style>
@endsection

