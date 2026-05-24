@extends('employees.master')

@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
</div>
@endif

<div class="container mt-5">
    <h1 class="text-primary mt-3 mb-4 text-center"><b>Quản lý Nhân viên</b></h1>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b></b></div>
            <div class="col col-md-6">
                <a href="{{ route('employees.create') }}" class="btn btn-success float-end">Thêm Nhân viên</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Ngày sinh</th>
                    <th>Phòng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if(count($employees) > 0)
                    @foreach($employees as $row)
                    <tr>
                        <td>{{ $row->Id }}</td>
                        <td>{{ $row->Name }}</td>
                        <td>{{ $row->Birthday }}</td>
                        <td>{{ $row->room->Name }}</td>
                        <td>
                            <a href="{{ route('employees.show', $row->Id) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('employees.edit', $row->Id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $row->Id }}">Xóa</button>

                            <!-- Modal Xác Nhận Xóa -->
                            <div class="modal fade" id="deleteModal{{ $row->Id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $row->Id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $row->StudentID }}">Xác nhận xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa nhân viên <strong>{{ $row->Name }}</strong> không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <form method="POST" action="{{ route('employees.destroy', $row->Id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Đồng ý Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">No Data Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {!! $employees->links() !!}
    </div>
</div>
@endsection