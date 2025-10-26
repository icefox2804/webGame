@extends('layouts.admin')

@section('title', 'Chỉnh sửa Game')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1>Chỉnh sửa Game</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Tên Game <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Thể loại <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id">
                            <option value="">-- Chọn thể loại --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price', $product->price) }}" min="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="stock" class="form-label">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Nhập 0 nếu hết hàng</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="age_rating" class="form-label">Độ tuổi phù hợp <span class="text-danger">*</span></label>
                        <select class="form-select @error('age_rating') is-invalid @enderror" 
                                id="age_rating" name="age_rating">
                            <option value="0" {{ old('age_rating', $product->age_rating) == '0' ? 'selected' : '' }}>Mọi lứa tuổi</option>
                            <option value="7" {{ old('age_rating', $product->age_rating) == '7' ? 'selected' : '' }}>7+</option>
                            <option value="12" {{ old('age_rating', $product->age_rating) == '12' ? 'selected' : '' }}>12+</option>
                            <option value="16" {{ old('age_rating', $product->age_rating) == '16' ? 'selected' : '' }}>16+</option>
                            <option value="18" {{ old('age_rating', $product->age_rating) == '18' ? 'selected' : '' }}>18+</option>
                        </select>
                        @error('age_rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh Game</label>
                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 150px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


