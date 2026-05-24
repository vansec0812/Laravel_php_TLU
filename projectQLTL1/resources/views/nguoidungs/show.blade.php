@extends('nguoidungs.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6">
                <b>Thông tin chi tiết người dùng</b>
            </div>
            <div class="col col-md-6">
                <a href="{{ route('nguoidungs.index') }}" class="btn btn-primary btn-sm float-end"><b>Xem tất cả danh sách</b></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Tên người dùng</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $nguoidung->TenNguoiDung }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Giới tính</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">@if($nguoidung->GioiTinh == 'Nam') Nam @else Nữ @endif</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Địa chỉ</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $nguoidung->DiaChi }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Điện thoại</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $nguoidung->DienThoai }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Email</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $nguoidung->Email }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Tài liệu</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $nguoidung->tailieu1 ? $nguoidung->tailieu1->TenTaiLieu : 'N/A' }}</p>
            </div>
        </div>
        <a href="{{ route('nguoidungs.index') }}" class="btn btn-primary btn-sm">Quay lại</a>
    </div>
</div>
@endsection
