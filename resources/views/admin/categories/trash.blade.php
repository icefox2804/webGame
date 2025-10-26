@extends('layouts.admin')

@section('title', 'Thùng Rác Thể Loại')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-trash"></i> Thùng Rác - Thể Loại Đã Xóa</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
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
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Thể Loại</th>
                                <th>Mô Tả</th>
                                <th>Số Game</th>
                                <th>Ngày Xóa</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td>{{ Str::limit($category->description ?? 'Không có mô tả', 50) }}</td>
                                <td>
                                    @if($category->products_count > 0)
                                        <span class="badge bg-warning">{{ $category->products_count }} game</span>
                                    @else
                                        <span class="badge bg-secondary">0 game</span>
                                    @endif
                                </td>
                                <td>{{ $category->deleted_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" 
                                                    onclick="return confirm('Bạn có chắc muốn khôi phục thể loại này?')">
                                                <i class="fas fa-undo"></i> Khôi phục
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.categories.forceDelete', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('CẢNH BÁO: Bạn có chắc muốn xóa vĩnh viễn thể loại này? Hành động này không thể hoàn tác!')">
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
                    {{ $categories->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <p class="mb-0">Thùng rác trống. Không có thể loại nào bị xóa.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

