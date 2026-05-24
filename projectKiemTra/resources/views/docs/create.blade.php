@extends('docs.master')

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
    <div class="card-header">Thêm Tài liệu mới</div>
    <div class="card-body">
        <form method="post" action="{{ route('docs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Tên tài liệu</label>
                <div class="col-sm-10">
                    <input type="text" name="Name_Doc" class="form-control" />
                </div>
            </div>
              <div class="row mb-3">
                <label class="col-md-2 col-label-form">Tên tác giả</label>
                <div class="col-sm-10">
                    <input type="text" name="Author" class="form-control" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-2 col-label-form">Mô tả</label>
                <div class="col-sm-10">
                    <input type="text" name="Des" class="form-control" />
                </div>
            </div>
           
            <div class="row mb-3">
                <label for="Id_DocType" class="form-label">Chọn tài liệu</label>
                <select id="Id_DocType" class="form-select" name="Id_DocType" required>
                    <option value="">- Chọn tài liệu -</option>
                    @foreach($_doc_types as $_doc_types)
                    <option value="{{$_doc_types->Id_DocType}}">{{$_doc_types->Name_DocType}}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
               <a href="{{ route('docs.index') }}" class="btn btn-success btn-sm">Quay lại</a>
               <input type="submit" name="add" class="btn btn-primary" value="Thêm" />
            </div>
        </form>
    </div>
</div>

@endsection('content')
