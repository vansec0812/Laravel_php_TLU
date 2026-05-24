@extends('students.master')

@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
</div>
@endif

<div class="container mt-5">
    <h1 class="text-primary mt-3 mb-4 text-center"><b>Quản lý sinh viên</b></h1>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b></b></div>
            <div class="col col-md-6">
                <a href="{{ route('students.create') }}" class="btn btn-success float-end">Thêm sinh viên</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Địa chỉ Email</th>
                    <th>Giới tính</th>
                    <th>Lớp</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if(count($students) > 0)
                    @foreach($students as $row)
                    <tr>
                        <td>{{ $row->StudentID }}</td>
                        <td>{{ $row->StudentName }}</td>
                        <td>{{ $row->StudentEmail }}</td>
                        <td>@if($row->StudentGender == '0') Nam @else Nữ @endif</td>
                        <td>{{ $row->classroom->ClassRoomName }}</td>
                        <td>
                            <a href="{{ route('students.show', $row->StudentID) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('students.edit', $row->StudentID) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $row->StudentID }}">Xóa</button>

                            <!-- Modal Xác Nhận Xóa -->
                            <div class="modal fade" id="deleteModal{{ $row->StudentID }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $row->StudentID }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $row->StudentID }}">Xác nhận xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa sinh viên <strong>{{ $row->StudentName }}</strong> không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <form method="POST" action="{{ route('students.destroy', $row->StudentID) }}">
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
        {!! $students->links() !!}
    </div>
</div>
@endsection