@extends('employees.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Thông tin nhân viên chi tiết</b></div>
            <div class="col col-md-6">
                <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm float-end"> Xem tất cả nhân viên</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Mã nhân viên</b></label>
            <div class="col-sm-10">
                {{ $employee->Id }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Tên nhân viên</b></label>
            <div class="col-sm-10">
                {{ $employee->Name }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Ngày sinh</b></label>
            <div class="col-sm-10">
                {{ $employee->Birthday }}
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-2 col-label-form"><b>Phòng</b></label>
            <div class="col-sm-10">
                {{ $employee->room->Name ?? 'N/A' }}
            </div>
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
@endsection