<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0e0e0e !important;
            color: #ffffff;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a1a 0%, #0e0e0e 100%);
            border-right: 2px solid rgba(255, 0, 68, 0.2);
        }
        
        .sidebar .nav-link {
            color: #ffffff;
            padding: 15px 25px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255, 0, 68, 0.1);
            border-left-color: #ff0044;
            padding-left: 30px;
            color: #ff0044;
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(255, 0, 68, 0.2);
            border-left-color: #ff0044;
            color: #ff0044;
            box-shadow: 0 0 20px rgba(255, 0, 68, 0.3);
        }
        
        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
        }
        
        .main-content {
            padding: 30px;
            background-color: #0e0e0e;
        }

        .sidebar h4 {
            text-shadow: 0 0 20px rgba(255, 0, 68, 0.5);
            font-weight: 700;
            letter-spacing: 2px;
        }

        .sidebar .btn-link {
            text-decoration: none;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar p-0">
                <div class="position-sticky">
                    <div class="text-center py-4 text-white">
                        <h4><i class="fas fa-gamepad"></i> Admin Panel</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                <i class="fas fa-list"></i> Quản lý thể loại
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                                <i class="fas fa-gamepad"></i> Quản lý game
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/contacts*') && !request()->is('admin/contacts-trash') ? 'active' : '' }}" href="{{ route('contacts.index') }}">
                                <i class="fas fa-envelope"></i> Quản lý liên hệ
                            </a>
                        </li>
                        
                        <!-- Trash Link -->
                        <li class="nav-item">
                            <hr class="border-secondary my-2">
                            <a class="nav-link {{ request()->is('admin/trash*') || request()->is('admin/*-trash') ? 'active' : '' }}" href="{{ route('admin.trash.index') }}">
                                <i class="fas fa-trash-alt"></i> Thùng Rác
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <hr class="border-secondary my-2">
                            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                <i class="fa-solid fa-house"></i> Xem trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-start w-100">
                                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

