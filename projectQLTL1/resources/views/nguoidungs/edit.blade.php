    @extends('nguoidungs.master')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card">
    <div class="card-header">Sửa người dùng</div>
    <div class="card-body">
        <form method="post" action="{{ route('nguoidungs.update', $nguoidung->NguoiDungID) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Tên người dùng</label>
                <div class="col-sm-10">
                    <input type="text" name="TenNguoiDung" class="form-control" value="{{$nguoidung->TenNguoiDung}}" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Giới tính</label>
                <div class="col-sm-10">
                    <select name="GioiTinh" class="form-control">
                        <option value="Nam" {{ $nguoidung->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nu" {{ $nguoidung->GioiTinh == 'Nu' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Địa chỉ</label>
                <div class="col-sm-10">
                    <input type="text" name="DiaChi" class="form-control" value="{{$nguoidung->DiaChi}}" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Điện thoại</label>
                <div class="col-sm-10">
                    <input type="text" name="DienThoai" class="form-control" value="{{$nguoidung->DienThoai}}" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="Email" class="form-control" value="{{$nguoidung->Email}}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="ID" class="form-label">Chọn tài liệu</label>
                <select id="ID" class="form-select" name="ID" required>
                    <option value="">- Chọn tài liệu -</option>
                    @foreach($tailieu1 as $tailieu1)
                    <option value="{{$tailieu1->ID}}" {{ $nguoidung->ID == $tailieu1->ID ? 'selected' : '' }}>
                        {{$tailieu1->TenTaiLieu}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <a href="{{ route('nguoidungs.index') }}" class="btn btn-success btn-sm">Quay lại</a>
                <input type="submit" name="edit" class="btn btn-primary" value="Sửa" />
            </div>
        </form>
    </div>
</div>
@endsection
