@extends('cnxds.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6">
                <b>Thông tin chi tiết công nhân</b>
            </div>
            <div class="col col-md-6">
                <a href="{{ route('cnxds.index') }}" class="btn btn-primary btn-sm float-end"><b>Xem tất cả danh sách</b></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Tên công nhân </b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $cnxd->Name }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Giới tính</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">@if($cnxd->GioiTinh == 'Nam') Nam @else Nữ @endif</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Email</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $cnxd->Email }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-2 col-form-label"><b>Vật liệu</b></label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{ $cnxd->vatlieu ? $cnxd->vatlieu->TenVatLieu : 'N/A' }}</p>
            </div>
        </div>
        <a href="{{ route('cnxds.index') }}" class="btn btn-primary btn-sm">Quay lại</a>
    </div>
</div>
@endsection
