@extends('layouts.admin')

@section('title', 'Th

ùng Rác Game')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-trash"></i> Thùng Rác - Game Đã Xóa</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Tên Game</th>
                                <th>Thể loại</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Ngày xóa</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" 
                                             style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    @else
                                        <div class="bg-secondary rounded" style="width: 50px; height: 50px;"></div>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if($product->category)
                                        <span class="badge bg-info">{{ $product->category->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    @if(isset($product->stock))
                                        @if($product->stock > 0)
                                            <span class="badge bg-success">{{ $product->stock }}</span>
                                        @else
                                            <span class="badge bg-danger">Hết hàng</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $product->deleted_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" 
                                                    onclick="return confirm('Bạn có chắc muốn khôi phục game này?')">
                                                <i class="fas fa-undo"></i> Khôi phục
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('CẢNH BÁO: Bạn có chắc muốn xóa vĩnh viễn game này? Hành động này không thể hoàn tác!')">
                                                <i class="fas fa-trash"></i> Xóa vĩnh viễn
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <p class="mb-0">Thùng rác trống. Không có game nào bị xóa.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

