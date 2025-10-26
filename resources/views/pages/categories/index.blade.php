@extends('layouts.app')

@section('title', $category->name . ' - Game Store')

@section('content')


<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="category-header">
        <h1><i class="fas fa-gamepad me-2"></i>{{ $category->name }}</h1>
        @if($category->description)
            <p>{{ $category->description }}</p>
        @endif
        <small class="text-white-50">
            <i class="fas fa-box-open me-1"></i>Tìm thấy {{ $products->total() }} game
        </small>
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
                    Chưa có game nào trong thể loại này!
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
    .category-header {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-left: 4px solid #ff0044;
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(255, 0, 68, 0.2);
    }
    
    .category-header h1 {
        color: #fff;
        margin-bottom: 0.5rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .category-header p {
        color: #aaa;
        margin-bottom: 0;
    }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 1.5rem;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        color: #ff0044;
        font-size: 1.2rem;
    }
    
    .breadcrumb-item a {
        color: #ff0044;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .breadcrumb-item a:hover {
        color: #ff3366;
        text-shadow: 0 0 10px rgba(255, 0, 68, 0.5);
    }
    
    .breadcrumb-item.active {
        color: #fff;
    }
</style>
@endsection

