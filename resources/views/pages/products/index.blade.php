@extends('layouts.app')

@section('title', 'Tất cả các game - Game Store')

@section('content')
<style>
    .products-header {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-left: 4px solid #ff0044;
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(255, 0, 68, 0.2);
    }
    
    .products-header h1 {
        color: #fff;
        margin-bottom: 0.5rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .filter-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%) !important;
        border: 1px solid rgba(255, 0, 68, 0.3) !important;
        box-shadow: 0 4px 20px rgba(255, 0, 68, 0.1) !important;
    }
    
    .filter-card .form-control,
    .filter-card .form-select {
        background: #0d0d0d;
        border: 1px solid rgba(255, 0, 68, 0.3);
        color: #fff;
    }
    
    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        background: #1a1a1a;
        border-color: #ff0044;
        box-shadow: 0 0 10px rgba(255, 0, 68, 0.3);
        color: #fff;
    }
    
    .filter-card .form-control::placeholder {
        color: #666;
    }
    
    .btn-reset {
        background: transparent;
        border: 1px solid #666;
        color: #aaa;
        transition: all 0.3s ease;
    }
    
    .btn-reset:hover {
        background: #ff0044;
        border-color: #ff0044;
        color: #fff;
        box-shadow: 0 0 15px rgba(255, 0, 68, 0.5);
    }
</style>

<div class="container my-5">
    <!-- Header -->
    <div class="products-header">
        <h1><i class="fas fa-gamepad me-2"></i>Tất Cả Game</h1>
        <small class="text-white-50">
            <i class="fas fa-box-open me-1"></i>Tìm thấy {{ $products->total() }} game
        </small>
    </div>

    <!-- Search & Filter -->
    <div class="card mb-4 filter-card">
        <div class="card-body">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label text-white-50 small"><i class="fas fa-search me-1"></i>Tìm kiếm</label>
                        <input type="text" class="form-control" name="search" placeholder="Nhập tên game..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-white-50 small"><i class="fas fa-list me-1"></i>Thể loại</label>
                        <select class="form-select" name="category">
                            <option value="">Tất cả thể loại</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-white-50 small"><i class="fas fa-dollar-sign me-1"></i>Giá từ</label>
                        <input type="number" class="form-control" name="min_price" placeholder="0đ" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-white-50 small"><i class="fas fa-dollar-sign me-1"></i>Giá đến</label>
                        <input type="number" class="form-control" name="max_price" placeholder="1,000,000đ" value="{{ request('max_price') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-white-50 small"><i class="fas fa-user-shield me-1"></i>Độ tuổi</label>
                        <select class="form-select" name="age_rating">
                            <option value="">Tất cả</option>
                            <option value="0" {{ request('age_rating') == '0' ? 'selected' : '' }}>Mọi lứa tuổi</option>
                            <option value="7" {{ request('age_rating') == '7' ? 'selected' : '' }}>7+</option>
                            <option value="12" {{ request('age_rating') == '12' ? 'selected' : '' }}>12+</option>
                            <option value="16" {{ request('age_rating') == '16' ? 'selected' : '' }}>16+</option>
                            <option value="18" {{ request('age_rating') == '18' ? 'selected' : '' }}>18+</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label class="form-label text-white-50 small"><i class="fas fa-sort me-1"></i>Sắp xếp</label>
                        <select class="form-select" name="sort">
                            <option value="">Mới nhất</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Tên Z-A</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('products.index') }}" class="btn btn-reset w-100">
                            <i class="fas fa-redo me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                @include('components.product-card', ['product' => $product, 'showDescription' => true])
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning bg-dark border-warning text-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Không tìm thấy game nào phù hợp với bộ lọc của bạn!
                    <br>
                    <small class="text-white-50 mt-2 d-block">Thử điều chỉnh bộ lọc hoặc <a href="{{ route('products.index') }}" class="text-danger">xóa bộ lọc</a></small>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection


