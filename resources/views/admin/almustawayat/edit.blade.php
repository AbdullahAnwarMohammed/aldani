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
                        تعديل مستوي || {{ $Almustawaya->name }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        @can('قائمة المستويات')
                            <a href="{{ route('admin.almustawayat.index') }}" class="btn btn-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                    width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 14l-4 -4l4 -4" />
                                    <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                                </svg>
                                المستويات</a>
                        @endcan


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
    <form  method="POST" action="{{route('admin.almustawayat.update',$Almustawaya->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" id="uploadId" name="uploadId">
        <div class="form-group mb-4">
            <label for="">الاسم <span class="text-danger">(*)</span> </label>
            <input type="text" name="name" value="{{$Almustawaya->name }}" id="name" required class="form-control">
        </div>
        <div class="form-group mb-2">
            <label for="">الملاحظات</label>
            <textarea name="comment" class="form-control" id="comment" cols="30" rows="10">{{$Almustawaya->comment}}</textarea>
        </div>
        <button type="submit" id="almustawayatSubmit" class="btn btn-teal">حفظ</button>
    </form>
@endsection
