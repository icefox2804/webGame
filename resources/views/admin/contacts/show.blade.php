@extends('layouts.admin')

@section('title', 'Chi tiết Liên hệ')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1>Chi tiết Liên hệ</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3"><strong>Tên:</strong></div>
                <div class="col-md-9">{{ $contact->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Email:</strong></div>
                <div class="col-md-9">{{ $contact->email }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Số điện thoại:</strong></div>
                <div class="col-md-9">{{ $contact->phone ?? 'Không có' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Ngày gửi:</strong></div>
                <div class="col-md-9">{{ $contact->created_at->format('d/m/Y H:i:s') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Nội dung:</strong></div>
                <div class="col-md-9">
                    <div class="border p-3 bg-light">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="fas fa-trash"></i> Xóa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


