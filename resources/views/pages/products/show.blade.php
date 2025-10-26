@extends('layouts.app')

@section('title', $product->name . ' - Game Store')

@section('content')
<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-dark p-3 rounded">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-danger">Sản phẩm</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="row product-detail-section">
        <div class="col-md-5 mb-4">
            <div class="product-detail-image bg-dark p-3 rounded position-relative">
                @if(isset($product->badge) && $product->badge)
                    <span class="product-badge position-absolute" style="top: 20px; right: 20px;">{{ $product->badge }}</span>
                @endif
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/500x500/1a1a1a/ffffff?text={{ urlencode($product->name) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <h1 class="text-white text-uppercase mb-3" style="font-weight: 700; letter-spacing: 2px;">{{ $product->name }}</h1>
            <div class="mb-4">
                <span class="badge bg-secondary me-2" style="font-size: 12px; padding: 8px 16px;">{{ $product->category->name }}</span>
                <span class="badge bg-info" style="font-size: 12px; padding: 8px 16px;">{{ $product->age_rating }}+</span>
                @if(isset($product->stock) && $product->stock > 0)
                    <span class="badge bg-success ms-2" style="font-size: 12px; padding: 8px 16px;">Còn hàng</span>
                @else
                    <span class="badge bg-secondary ms-2" style="font-size: 12px; padding: 8px 16px;">Hết hàng</span>
                @endif
            </div>
            
            @if(isset($product->discount_price) && $product->discount_price)
                <div class="mb-4">
                    <span class="text-decoration-line-through text-muted h5">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                    <h2 class="text-danger mb-0 mt-2" style="font-size: 2.5rem; font-weight: 700;">{{ number_format($product->discount_price, 0, ',', '.') }} VNĐ</h2>
                </div>
            @else
                <h2 class="text-danger mb-4" style="font-size: 2.5rem; font-weight: 700;">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h2>
            @endif
            
            <div class="mb-4 p-4 bg-dark rounded">
                <h5 class="text-white text-uppercase mb-3" style="letter-spacing: 1px;"><i class="fas fa-info-circle text-danger"></i> Mô tả:</h5>
                <p class="text-light opacity-75 mb-0">{{ $product->description ?? 'Chưa có mô tả' }}</p>
            </div>

            <div class="mb-4 p-4 bg-dark rounded">
                <div class="row text-white">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-tag text-danger"></i> Thể loại:
                        </h6>
                        <p class="mb-0 text-light opacity-75">{{ $product->category->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-child text-danger"></i> Độ tuổi:
                        </h6>
                        <p class="mb-0 text-light opacity-75">{{ $product->age_rating }}+</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-calendar text-danger"></i> Ngày thêm:
                        </h6>
                        <p class="mb-0 text-light opacity-75">{{ $product->created_at->format('d/m/Y') }}</p>
                    </div>
                    @if(isset($product->stock))
                        <div class="col-md-6">
                            <h6 class="text-uppercase" style="letter-spacing: 1px;">
                                <i class="fas fa-box text-danger"></i> Kho:
                            </h6>
                            <p class="mb-0 text-light opacity-75">{{ $product->stock }} sản phẩm</p>
                        </div>
                    @endif
                </div>
            </div>

            @if(isset($product->stock) && $product->stock > 0)
                <div class="d-grid gap-3">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg px-5 py-3 w-100" style="font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                    <form action="{{ route('cart.buyNow', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-lg px-5 py-3 w-100" style="font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                            <i class="fas fa-bolt"></i> Mua ngay
                        </button>
                    </form>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> <strong>Sản phẩm đã hết hàng!</strong>
                    <p class="mb-0 mt-2">Vui lòng liên hệ với chúng tôi để được thông báo khi sản phẩm có hàng trở lại.</p>
                </div>
                <button type="button" class="btn btn-secondary btn-lg px-5 py-3 w-100" disabled style="font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                    <i class="fas fa-times-circle"></i> Hết hàng
                </button>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h3 class="mb-4 text-white text-uppercase" style="letter-spacing: 2px;">
                <i class="fas fa-gamepad text-danger"></i> Game liên quan
            </h3>
            <div class="row">
                @foreach($relatedProducts as $related)
                    <div class="col-md-3 mb-4">
                        @include('components.product-card', ['product' => $related, 'showDescription' => false])
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

