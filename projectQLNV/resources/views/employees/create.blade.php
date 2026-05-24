@extends('employees.master')

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
    <div class="card-header">Thêm Nhân Viên Mới</div>
    <div class="card-body">
        <form method="POST" action="{{ route('employees.store') }}">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tên Nhân viên</label>
                <div class="col-sm-10">
                    <input type="text" name="Name" class="form-control" value="{{ old('Name') }}"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Birthday</label>
                <div class="col-sm-10">
                    <input type="date" name="Birthday" class="form-control" value="{{ old('Birthday') }}"/>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label">Phòng</label>
                <div class="col-sm-10">
                    <select name="roomsId" class="form-control">
                        <option value="">-- Chọn Phòng --</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->roomsId }}" {{ old('roomsId') == $room->roomsId ? 'selected' : '' }}>
                                {{ $room->Name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Thêm Nhân Viên" />
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Quay Lại</a>
            </div>
        </form>
    </div>
</div>

@endsection
