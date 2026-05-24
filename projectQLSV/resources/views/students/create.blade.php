@extends('students.master')

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
    <div class="card-header">Thêm Sinh Viên Mới</div>
    <div class="card-body">
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tên sinh viên</label>
                <div class="col-sm-10">
                    <input type="text" name="StudentName" class="form-control" value="{{ old('StudentName') }}"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="StudentEmail" class="form-control" value="{{ old('StudentEmail') }}"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Giới tính</label>
                <div class="col-sm-10">
                    <select name="StudentGender" class="form-control">
                        <option value="0" {{ old('StudentGender') == '0' ? 'selected' : '' }}>Nam</option>
                        <option value="1" {{ old('StudentGender') == '1' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label">Lớp</label>
                <div class="col-sm-10">
                    <select name="classRoomID" class="form-control">
                        <option value="">-- Chọn lớp --</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->classRoomID }}" {{ old('classRoomID') == $classroom->classRoomID ? 'selected' : '' }}>
                                {{ $classroom->ClassRoomName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Thêm Sinh Viên" />
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay Lại</a>
            </div>
        </form>
    </div>
</div>

@endsection
