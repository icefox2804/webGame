<header class="main-header">
    {{-- MAIN NAVIGATION --}}
    <nav class="navbar navbar-expand-lg navbar-dark main-nav py-4">
        <div class="container-fluid px-4">
            {{-- Mobile Toggle --}}
            <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="w-100 d-flex align-items-end justify-content-between">
                    
                    {{-- ICON SEARCH (FAR LEFT) --}}
                    <div class="nav-icon-left">
                        <a href="#" class="nav-icon-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>

                    {{-- CENTER GROUP: Menu Trái + Logo + Menu Phải --}}
                    <div class="nav-center-group d-flex align-items-end">
                        
                        {{-- LEFT SECTION: 2 tầng --}}
                        <div class="nav-section-left d-flex flex-column align-items-start">
                            {{-- Follow us on (TRÊN) --}}
                            <div class="d-flex align-items-center mb-3">
                                <span class="text-white-50 me-3" style="font-size: 11px; letter-spacing: 1px;">follow us on:</span>
                                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitch"></i></a>
                            </div>
                            
                            {{-- Menu Left (DƯỚI) - NGANG --}}
                            <ul class="navbar-nav flex-row align-items-center mb-0 ">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('home') }}">HOME</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">SHOP</a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="{{ route('products.index') }}"><i class="fas fa-th me-2"></i>Tất cả Game</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        @if(isset($headerCategories) && $headerCategories->count() > 0)
                                            @foreach($headerCategories as $cat)
                                                <li><a class="dropdown-item" href="{{ route('category.show', $cat->id) }}"><i class="fas fa-gamepad me-2"></i>{{ $cat->name }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        {{-- CENTER LOGO --}}
                        <div class="nav-logo mx-4">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('images/logo.svg') }}" alt="PlayerX Logo" style="height: 90px;">
                            </a>
                        </div>

                        {{-- RIGHT SECTION: 2 tầng --}}
                        <div class="nav-section-right d-flex flex-column align-items-end">
                            {{-- Tagline (TRÊN) --}}
                            <div class="mb-3">
                                <span class="tagline">this is playerx, a theme for games, clans & esports</span>
                            </div>
                            
                            {{-- Menu Right (DƯỚI) - NGANG --}}
                            <ul class="navbar-nav flex-row align-items-center mb-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact.create') }}">LIÊN HỆ</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle me-1"></i> MY ACCOUNT
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                        @auth
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa-user me-2"></i>Hi {{Auth::user()->name}}
                                                </a></li>
                                            
                                            @if(auth()->user()->role === 'admin')
                                                {{-- Menu cho Admin --}}
                                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                                
                                            @else
                                                <li><hr class="dropdown-divider"></li>
                                            @endif
                                            
                                            
                                            <li>
                                                @if(auth()->user()->role === 'admin' && request()->is('admin/*'))
                                                    <form action="{{ route('admin.logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('auth.logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</button>
                                                    </form>
                                                @endif
                                            </li>
                                        @else
                                            <li><a class="dropdown-item" href="{{ route('auth.login') }}"><i class="fas fa-sign-in-alt me-2"></i>Đăng nhập</a></li>
                                            <li><a class="dropdown-item" href="{{ route('auth.register') }}"><i class="fas fa-user-plus me-2"></i>Đăng ký</a></li>
                                        @endauth
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        
                    </div>

                    {{-- ICONS (FAR RIGHT) --}}
                    <div class="nav-icon-right d-flex align-items-center gap-3">
                        {{-- Cart Icon with Badge --}}
                        <a href="{{ route('cart.index') }}" class="nav-icon-btn position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                $cart = session()->get('cart', []);
                                $cartCount = array_sum(array_column($cart, 'quantity'));
                            @endphp
                            @if($cartCount > 0)
                                <span class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                    <span class="visually-hidden">sản phẩm trong giỏ</span>
                                </span>
                            @endif
                        </a>
                        
                        {{-- Fullscreen Icon --}}
                        <a href="#" class="nav-icon-btn" onclick="toggleFullscreen()">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-white" id="searchModalLabel">
                    <i class="fas fa-search text-danger"></i> Tìm Kiếm Game
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="input-group input-group-lg mb-3">
                        <input type="text" name="search" class="form-control bg-dark text-white border-secondary" 
                               placeholder="Nhập tên game bạn muốn tìm..." 
                               value="{{ request('search') }}"
                               id="searchInput"
                               autocomplete="off">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </form>

                <!-- Quick Search Results -->
                <div id="quickResults" class="mt-3" style="display: none;">
                    <h6 class="text-white-50 mb-3">Kết quả tìm kiếm:</h6>
                    <div id="resultsContainer"></div>
                </div>

                <!-- Popular Searches -->
                <div class="mt-4">
                    <h6 class="text-white-50 mb-3">Tìm kiếm phổ biến:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('products.index', ['search' => 'League of Legends']) }}" 
                           class="btn btn-sm btn-outline-secondary search-tag">
                            League of Legends
                        </a>
                        <a href="{{ route('products.index', ['search' => 'Wukong']) }}" 
                           class="btn btn-sm btn-outline-secondary search-tag">
                            Black Myth Wukong
                        </a>
                        <a href="{{ route('products.index', ['search' => 'GTA']) }}" 
                           class="btn btn-sm btn-outline-secondary search-tag">
                            GTA
                        </a>
                        <a href="{{ route('products.index', ['search' => 'FIFA']) }}" 
                           class="btn btn-sm btn-outline-secondary search-tag">
                            FIFA
                        </a>
                        <a href="{{ route('products.index', ['search' => 'Minecraft']) }}" 
                           class="btn btn-sm btn-outline-secondary search-tag">
                            Minecraft
                        </a>
                    </div>
                </div>

                <!-- Categories -->
                <div class="mt-4">
                    <h6 class="text-white-50 mb-3">Danh mục:</h6>
                    <div class="row">
                        @if(isset($headerCategories) && $headerCategories->count() > 0)
                            @foreach($headerCategories as $cat)
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('category.show', $cat->id) }}" 
                                   class="d-flex align-items-center text-white text-decoration-none category-link p-2 rounded">
                                    <i class="fas fa-gamepad text-danger me-2"></i>
                                    {{ $cat->name }}
                                </a>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cart-badge {
    font-size: 10px;
    padding: 4px 6px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        transform: translate(-50%, -50%) scale(1.1);
    }
}

.nav-icon-btn {
    position: relative;
    transition: all 0.3s ease;
}

.nav-icon-btn:hover .cart-badge {
    background-color: #ff0044 !important;
}

/* Search Modal Styles */
#searchModal .modal-content {
    background-color: #1a1a1a;
    box-shadow: 0 10px 50px rgba(255, 0, 68, 0.3);
}

#searchModal .form-control {
    background-color: #0e0e0e;
    border-color: #333;
    color: #fff;
}

#searchModal .form-control:focus {
    background-color: #0e0e0e;
    border-color: #ff0044;
    color: #fff;
    box-shadow: 0 0 0 0.2rem rgba(255, 0, 68, 0.25);
}

.search-tag {
    transition: all 0.3s ease;
}

.search-tag:hover {
    background-color: #ff0044;
    border-color: #ff0044;
    color: #fff;
    transform: translateY(-2px);
}

.category-link {
    transition: all 0.3s ease;
}

.category-link:hover {
    background-color: rgba(255, 0, 68, 0.1);
    transform: translateX(5px);
}

.search-result-item {
    padding: 10px;
    border-bottom: 1px solid #333;
    transition: all 0.3s ease;
}

.search-result-item:hover {
    background-color: rgba(255, 0, 68, 0.1);
}

.search-result-item:last-child {
    border-bottom: none;
}
</style>

<script>
function toggleFullscreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}

// Live Search Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const quickResults = document.getElementById('quickResults');
    const resultsContainer = document.getElementById('resultsContainer');
    let searchTimeout;

    if (searchInput) {
        // Focus input when modal opens
        const searchModal = document.getElementById('searchModal');
        searchModal.addEventListener('shown.bs.modal', function () {
            searchInput.focus();
        });

        // Clear results when modal closes
        searchModal.addEventListener('hidden.bs.modal', function () {
            searchInput.value = '';
            quickResults.style.display = 'none';
            resultsContainer.innerHTML = '';
        });

        // Live search on input
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                quickResults.style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`{{ route('products.index') }}?search=${encodeURIComponent(query)}`)
                    .then(response => response.text())
                    .then(html => {
                        // Parse HTML to extract product info
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const products = doc.querySelectorAll('.product-card, [class*="product"]');
                        
                        if (products.length > 0) {
                            displayQuickResults(query);
                        } else {
                            resultsContainer.innerHTML = '<p class="text-white-50">Không tìm thấy game nào phù hợp</p>';
                            quickResults.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                    });
            }, 500);
        });

        // Enter key to submit
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    }

    function displayQuickResults(query) {
        resultsContainer.innerHTML = `
            <div class="text-center py-3">
                <p class="text-white mb-3">Đang tìm kiếm "<span class="text-danger">${query}</span>"</p>
                <button type="button" class="btn btn-danger" onclick="document.querySelector('#searchModal form').submit()">
                    <i class="fas fa-search"></i> Xem tất cả kết quả
                </button>
            </div>
        `;
        quickResults.style.display = 'block';
    }
});
</script>