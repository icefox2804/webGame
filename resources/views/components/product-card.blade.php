<div class="card product-card h-100 bg-dark border-0">
    <div class="product-image-wrapper position-relative overflow-hidden">
        @if($product->image)
            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
        @else
            <img src="https://via.placeholder.com/300x400/1a1a1a/ffffff?text={{ urlencode($product->name) }}" class="card-img-top" alt="{{ $product->name }}">
        @endif
        
        
        <!-- Badges -->
        @if(isset($product->badge) && $product->badge)
            <span class="product-badge position-absolute">{{ $product->badge }}</span>
        @endif
        
        <!-- Overlay with Quick Actions -->
        <div class="product-overlay mb-2">           
            <a href="{{ route('product.show', $product->id) }}" class="btn btn-danger btn-overlay">
                Xem Ngay
            </a>
        </div>
        
    </div>
    
    <div class="card-body d-flex flex-column">
        <h5 class="card-title text-white text-uppercase mb-2">{{ Str::limit($product->name, 30) }}</h5>
        <div class="product-category text-uppercase mb-2">
            <span class="badge bg-secondary">{{ $product->category->name }}</span>
            <span class="badge bg-info ms-1">{{ $product->age_rating }}+</span>
        </div>
               
        @if(isset($showDescription) && $showDescription)
            <p class="card-text text-light opacity-75 small mb-3">{{ Str::limit($product->description ?? '', 80) }}</p>
        @endif
        
        <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                @if(isset($product->discount_price) && $product->discount_price)
                    <div class="product-price">
                        <span class="text-decoration-line-through text-light opacity-75 small">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                        <span class="text-danger fw-bold d-block">{{ number_format($product->discount_price, 0, ',', '.') }} VNĐ</span>
                    </div>
                @else
                    <strong class="text-danger fs-5">{{ number_format($product->price, 0, ',', '.') }} VNĐ</strong>
                @endif
                
                @if(isset($product->stock))
                    @if($product->stock > 0)
                        <span class="badge bg-success">Còn hàng</span>
                    @else
                        <span class="badge bg-secondary">Hết hàng</span>
                    @endif
                @endif
            </div>                        
        </div>
    </div>
</div>
