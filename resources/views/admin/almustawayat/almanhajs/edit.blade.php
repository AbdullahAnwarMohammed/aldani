@extends('admin.layouts.app')
@section('header')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    وحدة التحكم
                </div>
                <h2 class="page-title">
                   تعديل منهج {{$Item->title}} | مستوي {{$Item->almustawayat->name}}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                        <a href="{{ route('admin.almustawayat.index') }}" class="btn btn-dark">للخلف</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

@if (Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
@endif

<form action="{{route('admin.almustawayat.almanhaj.update',$Item->id)}}" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" name="title" value="{{$Item->title}}" class="form-control">
    </div>
    <div class="form-group my-2">
        <input type="submit" class="btn btn-success" value="حفظ">
    </div>
</form>
@endsection