@extends('noitros.master')

@section('content')
@if($message = Session::get('success'))
<div class="alert alert-success">
    {{$message}}
</div>
@endif
<div class="container mt-5">
    <h1 class="text-primary mt-3 mb-4 text-center"><b1>Quản lý Nội trợ</b1></h1>
</div>
<div class="card">
    <div class="card=header">
        <div class="row">
            <div class ="col col-md-6"><b></b></div>
            <div class="'col col-md-6">
                <a href="{{ route('noitros.create') }}" class="btn btn-success btn-sm float-end">
                    <b>Thêm Nội trợ</b>  
                </a>
            </div>
        </div>
    </div>
    <div class="'card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Tên Nội trợ</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>Nội thất</th>
                <th>Action</th>
            </tr>
            @if(count($noitros)>0)
                @foreach($noitros as $row)
                <tr>
                    <td>{{$row->NoiTroID}}</td>
                    <td>{{$row->Name}}</td>
                    <td>@if($row->GioiTinh == 'Nam') Nam @else Nữ @endif</td>
                    <td>{{$row->Email}}</td>
                    <td>{{ $row->noithat ? $row->noithat->TenNoiThat : 'N/A' }}</td>
                    <td>
                        <form method="post" action="{{ route('noitros.destroy', $row->NoiTroID) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('noitros.show', $row->NoiTroID) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('noitros.edit', $row->NoiTroID) }}" class="btn btn-warning btn-sm">Sửa</a>
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
        {!! $noitros->links()!!}
    </div>
</div>
@endsection