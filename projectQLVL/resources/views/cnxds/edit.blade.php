    @extends('cnxds.master')
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
        <form method="post" action="{{ route('cnxds.update', $cnxd->CNID) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Tên công nhân</label>
                <div class="col-sm-10">
                    <input type="text" name="Name" class="form-control" value="{{$cnxd->Name}}" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Giới tính</label>
                <div class="col-sm-10">
                    <select name="GioiTinh" class="form-control">
                        <option value="Nam" {{ $cnxd->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nu" {{ $cnxd->GioiTinh == 'Nu' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="Email" class="form-control" value="{{$cnxd->Email}}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="ID" class="form-label">Chọn vật liệu</label>
                <select id="ID" class="form-select" name="ID" required>
                    <option value="">- Chọn vật liệu -</option>
                    @foreach($vatlieu as $vatlieu)
                    <option value="{{$vatlieu->ID}}" {{ $cnxd->ID == $vatlieu->ID ? 'selected' : '' }}>
                        {{$vatlieu->TenVatLieu}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <a href="{{ route('cnxds.index') }}" class="btn btn-success btn-sm">Quay lại</a>
                <input type="submit" name="edit" class="btn btn-primary" value="Sửa" />
            </div>
        </form>
    </div>
</div>
@endsection
