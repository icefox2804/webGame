@extends('layouts.admin')

@section('title', 'Thùng Rác - Tổng Quan')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-trash-alt me-3"></i>Thùng Rác
    </h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <!-- Games Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('admin.products.trash') }}" class="stat-card-link">
                <div class="stat-card stat-card-clickable">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="stat-value">{{ $productsCount }}</h1>
                            <p class="stat-label">Game Đã Xóa</p>
                            <span class="stat-badge">
                                <i class="fas fa-gamepad me-1"></i>Products
                            </span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Categories Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('admin.categories.trash') }}" class="stat-card-link">
                <div class="stat-card stat-card-clickable">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="stat-value">{{ $categoriesCount }}</h1>
                            <p class="stat-label">Thể Loại Đã Xóa</p>
                            <span class="stat-badge">
                                <i class="fas fa-layer-group me-1"></i>Categories
                            </span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Contacts Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('admin.contacts.trash') }}" class="stat-card-link">
                <div class="stat-card stat-card-clickable">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="stat-value">{{ $contactsCount }}</h1>
                            <p class="stat-label">Liên Hệ Đã Xóa</p>
                            <span class="stat-badge">
                                <i class="fas fa-envelope me-1"></i>Contacts
                            </span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Deleted Products -->
    <div class="chart-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5><i class="fas fa-gamepad me-2"></i>Game Đã Xóa Gần Đây</h5>
            @if($productsCount > 0)
                <a href="{{ route('admin.products.trash') }}" class="btn btn-sm btn-outline-danger">
                    Xem tất cả ({{ $productsCount }})
                </a>
            @endif
        </div>
        @if($recentProducts->isEmpty())
            <div class="text-center py-4">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Không có game nào trong thùng rác</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="gaming-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px">Ảnh</th>
                            <th>Tên Game</th>
                            <th>Thể Loại</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Ngày Xóa</th>
                            <th style="width: 180px">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentProducts as $product)
                            <tr>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="product-thumb">
                                    @else
                                        <div class="product-thumb bg-secondary d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $product->name }}</strong></td>
                                <td>
                                    @if($product->category)
                                        <span class="badge-category">{{ $product->category->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">Không có</span>
                                    @endif
                                </td>
                                <td><strong class="text-danger">{{ number_format($product->price, 0, ',', '.') }} VNĐ</strong></td>
                                <td>
                                    <span class="stat-badge">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td><small>{{ $product->deleted_at->format('d/m/Y H:i') }}</small></td>
                                <td>
                                    <form action="{{ route('admin.products.restore', $product->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm btn-success" 
                                                title="Khôi phục">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.products.forceDelete', $product->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn game này? Hành động này không thể hoàn tác!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Xóa vĩnh viễn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Recent Deleted Categories -->
    <div class="chart-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5><i class="fas fa-layer-group me-2"></i>Thể Loại Đã Xóa Gần Đây</h5>
            @if($categoriesCount > 0)
                <a href="{{ route('admin.categories.trash') }}" class="btn btn-sm btn-outline-danger">
                    Xem tất cả ({{ $categoriesCount }})
                </a>
            @endif
        </div>
        @if($recentCategories->isEmpty())
            <div class="text-center py-4">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Không có thể loại nào trong thùng rác</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="gaming-table mb-0">
                    <thead>
                        <tr>
                            <th>Tên Thể Loại</th>
                            <th>Số Game Liên Quan</th>
                            <th>Ngày Xóa</th>
                            <th style="width: 180px">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentCategories as $category)
                            <tr>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td>
                                    @if($category->products_count > 0)
                                        <span class="stat-badge">
                                            {{ $category->products_count }} game
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">0 game</span>
                                    @endif
                                </td>
                                <td><small>{{ $category->deleted_at->format('d/m/Y H:i') }}</small></td>
                                <td>
                                    <form action="{{ route('admin.categories.restore', $category->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm btn-success" 
                                                title="Khôi phục">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.categories.forceDelete', $category->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn thể loại này? Hành động này không thể hoàn tác!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Xóa vĩnh viễn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Recent Deleted Contacts -->
    <div class="chart-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5><i class="fas fa-envelope me-2"></i>Liên Hệ Đã Xóa Gần Đây</h5>
            @if($contactsCount > 0)
                <a href="{{ route('admin.contacts.trash') }}" class="btn btn-sm btn-outline-danger">
                    Xem tất cả ({{ $contactsCount }})
                </a>
            @endif
        </div>
        @if($recentContacts->isEmpty())
            <div class="text-center py-4">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Không có liên hệ nào trong thùng rác</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="gaming-table mb-0">
                    <thead>
                        <tr>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Tin Nhắn</th>
                            <th>Ngày Xóa</th>
                            <th style="width: 180px">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentContacts as $contact)
                            <tr>
                                <td><strong>{{ $contact->name }}</strong></td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone ?? '-' }}</td>
                                <td>
                                    {{ Str::limit($contact->message, 50) }}
                                </td>
                                <td><small>{{ $contact->deleted_at->format('d/m/Y H:i') }}</small></td>
                                <td>
                                    <form action="{{ route('admin.contacts.restore', $contact->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm btn-success" 
                                                title="Khôi phục">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.contacts.forceDelete', $contact->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn liên hệ này? Hành động này không thể hoàn tác!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Xóa vĩnh viễn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

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
        content: '\f35d';
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

    /* Table Gaming Style */
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

    /* Table Container */
    .chart-card .table-responsive {
        margin: -25px;
        margin-top: 0;
        border-radius: 0 0 12px 12px;
        overflow: hidden;
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

    .product-thumb.bg-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
</style>
@endsection

