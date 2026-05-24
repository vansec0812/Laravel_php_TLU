@extends('students.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Thông tin sinh viên chi tiết</b></div>
            <div class="col col-md-6">
                <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm float-end"> Xem tất cả sinh viên</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Mã sinh viên</b></label>
            <div class="col-sm-10">
                {{ $student->StudentID }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Tên sinh viên</b></label>
            <div class="col-sm-10">
                {{ $student->StudentName }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Địa chỉ Email</b></label>
            <div class="col-sm-10">
                {{ $student->StudentEmail }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Giới tính</b></label>
            <div class="col-sm-10">
                @if($student->StudentGender == '0') Nam @else Nữ @endif
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-2 col-label-form"><b>Lớp</b></label>
            <div class="col-sm-10">
                {{ $student->classroom->ClassRoomName ?? 'N/A' }}
            </div>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
@endsection