@extends('cnxds.master')

@section('content')
@if($message = Session::get('success'))
<div class="alert alert-success">
    {{$message}}
</div>
@endif
<div class="container mt-5">
    <h1 class="text-primary mt-3 mb-4 text-center"><b1>Quản lý Công nhân</b1></h1>
</div>
<div class="card">
    <div class="card=header">
        <div class="row">
            <div class ="col col-md-6"><b></b></div>
            <div class="'col col-md-6">
                <a href="{{ route('cnxds.create') }}" class="btn btn-success btn-sm float-end">
                    <b>Thêm người dùng</b>  
                </a>
            </div>
        </div>
    </div>
    <div class="'card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Tên công nhân</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>Vật liệu</th>
                <th>Action</th>
            </tr>
            @if(count($cnxds)>0)
                @foreach($cnxds as $row)
                <tr>
                    <td>{{$row->CNID}}</td>
                    <td>{{$row->Name}}</td>
                    <td>@if($row->GioiTinh == 'Nam') Nam @else Nữ @endif</td>
                    <td>{{$row->Email}}</td>
                    <td>{{ $row->vatlieu ? $row->vatlieu->TenVatLieu : 'N/A' }}</td>
                    <td>
                        <form method="post" action="{{ route('cnxds.destroy', $row->CNID) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('cnxds.show', $row->CNID) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('cnxds.edit', $row->CNID) }}" class="btn btn-warning btn-sm">Sửa</a>
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
        {!! $cnxds->links()!!}
    </div>
</div>
@endsection