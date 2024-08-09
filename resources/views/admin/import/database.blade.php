@extends('admin.layouts.app')
@section('content')
<div class="container">

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif
    <div class="row">
        <div class="col-12">
           <div class="card">
            <div class="card-body">
                <h3> استيراد قاعدة البيانات [SQL]</h3>
                <form action="{{route('admin.import.store.database')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-10">
                            <input type="file" name="sql_file" class="form-control" >
                        </div>
                        <div class="col">
                            <input type="submit" value="استيراد" class="btn btn-danger">
                        </div>
                    </div>
                </form>
            </div>
           </div>
        </div>
        <div class="col-12 my-2">
           <div class="card">
            <div class="card-body">
                <h3> استيراد جدول [EXCEL]</h3>
                <form action="{{route('admin.import.store.database.excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <select name="type" class="form-control">
                                <option value="1">الطلاب</option>
                                <option value="2">المحفظين</option>
                                <option value="3">المستخدمين</option>
                                <option value="4">الحلقات</option>
                                <option value="5">المستويات</option>
                                <option value="6">درجات الحلقات</option>
                                <option value="7">درجات الاختبارات</option>
                              </select>
                        </div>
                        <div class="col-6">
                            <input type="file" name="sql_file" class="form-control" required>
                        </div>
                        <div class="col">
                            <input type="submit" value="استيراد" class="btn btn-danger">
                        </div>
                    </div>
                </form>
            </div>
           </div>
        </div>
    </div>
</div>
@endsection