@extends('nguoidungs.master')

@section('content')
@if($message = Session::get('success'))
<div class="alert alert-success">
    {{$message}}
</div>
@endif
<div class="container mt-5">
    <h1 class="text-primary mt-3 mb-4 text-center"><b1>Quản lý người dùng</b1></h1>
</div>
<div class="card">
    <div class="card=header">
        <div class="row">
            <div class ="col col-md-6"><b></b></div>
            <div class="'col col-md-6">
                <a href="{{ route('nguoidungs.create') }}" class="btn btn-success btn-sm float-end">
                    <b>Thêm người dùng</b>  
                </a>
            </div>
        </div>
    </div>
    <div class="'card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Tài liệu</th>
                <th>Action</th>
            </tr>
            @if(count($nguoidungs)>0)
                @foreach($nguoidungs as $row)
                <tr>
                    <td>{{$row->NguoiDungID}}</td>
                    <td>{{$row->TenNguoiDung}}</td>
                    <td>@if($row->GioiTinh == 'Nam') Nam @else Nữ @endif</td>
                    <td>{{$row->DiaChi}}</td>
                    <td>{{$row->DienThoai}}</td>
                    <td>{{$row->Email}}</td>
                    <td>{{ $row->tailieu1 ? $row->tailieu1->TenTaiLieu : 'N/A' }}</td>
                    <td>
                        <form method="post" action="{{ route('nguoidungs.destroy', $row->NguoiDungID) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('nguoidungs.show', $row->NguoiDungID) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('nguoidungs.edit', $row->NguoiDungID) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">Không có dữ liệu</td>
                </tr>
            @endif
        </table>
        {!! $nguoidungs->links()!!}
    </div>
</div>
@endsection