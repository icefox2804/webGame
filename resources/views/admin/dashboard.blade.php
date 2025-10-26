@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('styles')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-chart-line me-3"></i>Dashboard Gaming Admin
    </h1>

    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <!-- Total Products -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admin.products.index') }}" class="stat-card-link">
                <div class="stat-card stat-card-clickable">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="stat-value">{{ $totalProducts }}</h1>
                            <p class="stat-label">Tổng Game</p>
                            <span class="stat-badge">
                                <i class="fas fa-plus me-1"></i>{{ $productsThisMonth }} Tháng này
                            </span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Categories -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('categories.index') }}" class="stat-card-link">
                <div class="stat-card stat-card-clickable">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="stat-value">{{ $totalCategories }}</h1>
                            <p class="stat-label">Thể loại</p>
                            <span class="stat-badge">
                                <i class="fas fa-list me-1"></i>Categories
                            </span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Contacts -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('contacts.index') }}" class="stat-card-link">
                <div class="stat-card stat-card-clickable">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="stat-value">{{ $totalContacts }}</h1>
                            <p class="stat-label">Liên hệ</p>
                            <span class="stat-badge">
                                <i class="fas fa-plus me-1"></i>{{ $contactsThisMonth }} Tháng này
                            </span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                </div>
            </div>
                </div>
            </a>
        </div>

        <!-- Total Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1 class="stat-value">{{ $totalUsers }}</h1>
                        <p class="stat-label">Người dùng</p>
                        <span class="stat-badge">
                            <i class="fas fa-plus me-1"></i>{{ $usersThisMonth }} Tháng này
                        </span>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Products Chart -->
        <div class="col-xl-8 mb-4">
            <div class="chart-card">
                <h5><i class="fas fa-chart-area me-2"></i>Thống kê Game theo tháng</h5>
                <canvas id="productsChart" height="80"></canvas>
            </div>
        </div>

        <!-- Category Stats -->
        <div class="col-xl-4 mb-4">
            <div class="chart-card">
                <h5><i class="fas fa-trophy me-2"></i>Top Thể loại</h5>
                <div class="mt-3">
                    @foreach($categoryStats as $category)
                    <div class="category-stat-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-white fw-bold">{{ $category->name }}</span>
                            <span class="stat-badge">{{ $category->products_count }} Games</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $totalProducts > 0 ? ($category->products_count / $totalProducts * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="text-white mb-3 text-uppercase" style="letter-spacing: 2px;">
                <i class="fas fa-bolt me-2"></i>Thao tác nhanh
            </h5>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('admin.products.create') }}" class="quick-action-btn">
                <i class="fas fa-plus-circle"></i>
                <span>Thêm Game Mới</span>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('categories.index') }}" class="quick-action-btn">
                <i class="fas fa-list-alt"></i>
                <span>Quản lý Thể loại</span>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('contacts.index') }}" class="quick-action-btn">
                <i class="fas fa-inbox"></i>
                <span>Xem Liên hệ</span>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('home') }}" class="quick-action-btn" target="_blank">
                <i class="fas fa-home"></i>
                <span>Xem Trang Chủ</span>
            </a>
        </div>
    </div>

    <!-- Recent Products & Contacts Row -->
    <div class="row">
        <!-- Recent Products -->
        <div class="col-xl-8 mb-4">
            <div class="chart-card">
                <h5 class="mb-4"><i class="fas fa-fire me-2"></i>Game Mới Nhất</h5>
                <div class="table-responsive">
                    <table class="table gaming-table mb-0">
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên Game</th>
                                <th>Thể loại</th>
                                <th>Giá</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProducts as $product)
                            <tr>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('images/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="product-thumb">
                                    @else
                                        <div class="product-thumb bg-secondary d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                </td>
                                <td>
                                    <span class="badge-category">
                                        {{ $product->category->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <strong class="text-danger">{{ number_format($product->price, 0, ',', '.') }} VNĐ</strong>
                                </td>
                                <td>
                                    <small>{{ $product->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Chưa có sản phẩm nào
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Contacts -->
        <div class="col-xl-4 mb-4">
            <div class="chart-card">
                <h5 class="mb-4"><i class="fas fa-comments me-2"></i>Liên hệ Mới</h5>
                @forelse($recentContacts as $contact)
                <div class="category-stat-item">
                    <div class="d-flex align-items-start">
                        <div class="stat-icon me-3" style="width: 45px; height: 45px; font-size: 18px;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-white mb-1">{{ $contact->name }}</h6>
                            <small class="text-light opacity-75 d-block mb-1">
                                <i class="fas fa-envelope me-1"></i>{{ $contact->email }}
                            </small>
                            <small class="text-light opacity-75">
                                <i class="fas fa-clock me-1"></i>{{ $contact->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-muted">Chưa có liên hệ nào</p>
                @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Products Chart
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    const productsChart = new Chart(productsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($productsChart, 'label')) !!},
            datasets: [{
                label: 'Games',
                data: {!! json_encode(array_column($productsChart, 'value')) !!},
                borderColor: '#ff0044',
                backgroundColor: 'rgba(255, 0, 68, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ff0044',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
            }, {
                label: 'Liên hệ',
                data: {!! json_encode(array_column($contactsChart, 'value')) !!},
                borderColor: '#00ff88',
                backgroundColor: 'rgba(0, 255, 136, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#00ff88',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#ffffff',
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        padding: 20,
                        usePointStyle: true,
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ff0044',
                    bodyColor: '#ffffff',
                    borderColor: '#ff0044',
                    borderWidth: 2,
                    padding: 12,
                    displayColors: true,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        drawBorder: false,
                    },
                    ticks: {
                        color: '#888',
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false,
                    },
                    ticks: {
                        color: '#888',
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

<style>
    /* Stats Cards Gaming Theme */
    .stat-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #0e0e0e 100%);
        border: 2px solid rgba(255, 0, 68, 0.3);
        border-radius: 12px;
        padding: 25px;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 0, 68, 0.1) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        border-color: #ff0044;
        box-shadow: 0 20px 40px rgba(255, 0, 68, 0.4);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ff0044 0%, #cc0036 100%);
        border-radius: 12px;
        font-size: 32px;
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(255, 0, 68, 0.4);
        transition: all 0.4s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 30px rgba(255, 0, 68, 0.6);
    }

    .stat-value {
        font-size: 42px;
        font-weight: 700;
        color: #ffffff;
        text-shadow: 0 0 20px rgba(255, 0, 68, 0.5);
        margin: 0;
        line-height: 1;
    }

    .stat-label {
        font-size: 14px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
        margin-top: 8px;
    }

    .stat-badge {
        background: rgba(255, 0, 68, 0.2);
        color: #ff0044;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* Clickable Stats Card */
    .stat-card-link {
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .stat-card-clickable {
        cursor: pointer;
        position: relative;
    }

    .stat-card-clickable::after {
        content: '\f35d';  /* Font Awesome external-link icon */
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 14px;
        color: rgba(255, 0, 68, 0.3);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .stat-card-clickable:hover::after {
        opacity: 1;
        transform: translateX(5px);
    }

    .stat-card-clickable:active {
        transform: translateY(-8px) scale(0.98);
    }

    /* Chart Card */
    .chart-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #0e0e0e 100%);
        border: 2px solid rgba(255, 0, 68, 0.3);
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s ease;
    }

    .chart-card:hover {
        border-color: rgba(255, 0, 68, 0.6);
        box-shadow: 0 10px 30px rgba(255, 0, 68, 0.2);
    }

    .chart-card h5 {
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 20px;
        text-shadow: 0 0 10px rgba(255, 0, 68, 0.3);
    }

    /* Table Gaming Style - Giống Stat Cards */
    .gaming-table {
        background: linear-gradient(135deg, #1a1a1a 0%, #0e0e0e 100%) !important;
        border: none;
        border-radius: 0;
        overflow: hidden;
    }

    .gaming-table thead {
        background: linear-gradient(135deg, #1a1a1a 0%, #0e0e0e 100%) !important;
        border-bottom: 2px solid rgba(255, 0, 68, 0.3);
    }

    .gaming-table thead th {
        color: #ffffff !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 11px;
        padding: 18px 15px;
        border: none !important;
        background: transparent !important;
        text-shadow: 0 0 10px rgba(255, 0, 68, 0.3);
    }

    .gaming-table tbody {
        background: linear-gradient(135deg, #1a1a1a 0%, #0e0e0e 100%) !important;
    }

    .gaming-table tbody tr {
        background: transparent !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }

    .gaming-table tbody tr:hover {
        background: rgba(255, 0, 68, 0.1) !important;
        transform: translateX(5px);
    }

    .gaming-table tbody td {
        padding: 15px;
        color: #ffffff !important;
        vertical-align: middle;
        border: none !important;
        background: transparent !important;
        font-size: 14px;
    }

    .gaming-table tbody td strong {
        color: #ffffff !important;
        font-weight: 600;
    }

    .gaming-table tbody td small {
        color: #888 !important;
    }

    .gaming-table .text-danger {
        color: #ff0044 !important;
        font-weight: 600;
    }

    /* Table Container - Giống Stat Cards */
    .chart-card .table-responsive {
        margin: -25px;
        margin-top: 0;
        border-radius: 0 0 12px 12px;
        overflow: hidden;
    }

    /* Quick Action Buttons */
    .quick-action-btn {
        background: linear-gradient(135deg, #1a1a1a 0%, #0e0e0e 100%);
        border: 2px solid rgba(255, 0, 68, 0.3);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        color: #ffffff;
    }

    .quick-action-btn:hover {
        background: linear-gradient(135deg, #ff0044 0%, #cc0036 100%);
        border-color: #ff0044;
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(255, 0, 68, 0.5);
        color: #ffffff;
    }

    .quick-action-btn i {
        font-size: 32px;
        margin-bottom: 10px;
        display: block;
    }

    .quick-action-btn span {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Badge Styles */
    .badge-category {
        background: rgba(255, 0, 68, 0.2) !important;
        color: #ff0044 !important;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255, 0, 68, 0.3);
    }

    /* Page Title */
    .page-title {
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        text-shadow: 0 0 30px rgba(255, 0, 68, 0.5);
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #ff0044 0%, transparent 100%);
    }

    /* Category Stats */
    .category-stat-item {
        background: #1a1a1a;
        border: 1px solid rgba(255, 0, 68, 0.2);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .category-stat-item:hover {
        background: rgba(255, 0, 68, 0.1);
        border-color: #ff0044;
        transform: translateX(5px);
    }

    .progress {
        background-color: rgba(255, 255, 255, 0.1);
        height: 8px;
        border-radius: 4px;
    }

    .progress-bar {
        background: linear-gradient(90deg, #ff0044 0%, #cc0036 100%);
        box-shadow: 0 0 10px rgba(255, 0, 68, 0.5);
    }

    /* Image Thumbnail */
    .product-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid rgba(255, 0, 68, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .product-thumb:hover {
        transform: scale(2.5);
        z-index: 999;
        border-color: #ff0044;
        box-shadow: 0 8px 25px rgba(255, 0, 68, 0.6);
    }

    /* Placeholder for missing image */
    .product-thumb.bg-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
</style>
@endsection