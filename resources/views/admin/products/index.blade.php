@extends('layouts.admin')

@section('title', 'Quản lý Game')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý Game</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-danger">
            <i class="fas fa-plus"></i> Thêm game mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">
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
                            <th>Độ tuổi</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/50" alt="No image">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if($product->category)
                                        {{ $product->category->name }}
                                    @else
                                        <span class="text-muted">Trống</span>
                                    @endif
                                </td>
                                <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->age_rating }}+</td>
                                <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Chưa có game nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection


