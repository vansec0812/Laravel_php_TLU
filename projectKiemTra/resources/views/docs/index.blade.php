@extends('docs.master')

@section('content')
@if($message = Session::get('success'))
<div class="alert alert-success">
    {{$message}}
</div>
@endif
<div class="container mt-5">
    <h1 class="text-primary mt-3 mb-4 text-center"><b1>Quản lý Tài liệu</b1></h1>
</div>
<div class="card">
    <div class="card=header">
        <div class="row">
            <div class ="col col-md-6"><b></b></div>
            <div class="'col col-md-6">
                <a href="{{ route('docs.create') }}" class="btn btn-success btn-sm float-end">
                    <b>Thêm tài liệu</b>  
                </a>
            </div>
        </div>
    </div>
    <div class="'card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Tên tài liệu</th>
                <th>Tác giả</th>
                <th>Mô Tả</th>
                <th>Loại</th>
                <th>Action</th>
            </tr>
            @if(count($docs)>0)
                @foreach($docs as $row)
                <tr>
                    <td>{{$row->Id_Doc}}</td>
                    <td>{{$row->Name_Doc}}</td>
                    <td>{{$row->Author}}</td>
                   
                    <td>{{$row->Des}}</td>
                    <td>{{ $row->_doc_types ? $row->_doc_types->Name_DocType : 'N/A' }}</td>
                    <td> 
                        <form method="post" action="{{ route('docs.destroy', $row->Id_Doc) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('docs.show', $row->Id_Doc) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('docs.edit', $row->Id_Doc) }}" class="btn btn-warning btn-sm">Sửa</a>
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
        {!! $docs->links()!!}
    </div>
</div>
@endsection