@extends('admin.layouts.app')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        وحدة التحكم
                    </div>
                    <h2 class="page-title">
                        تعديل : {{$Room->name}}

                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <a href="{{ route('admin.rooms.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                            </svg>
                            الغرف
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="row">
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <form action="{{ route('admin.rooms.update', $Room->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">اسم الغرفة</label>
                <input type="text" name="name" value="{{ $Room->name }}" required class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="">رابط الميتنج</label>
                <input type="text" name="url" value="{{ $Room->url }}" required class="form-control">
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">الحلقة</label>
                <select name="alhalaqat_id" class="form-control" id="">
                    @foreach ($Alhalaqats as $item)
                        <option value="{{ $item->id }}" @selected($Room->alhalaqat_id == $item->id)>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group my-4">
                <input type="submit" class="btn btn-teal" value="تعديل">
            </div>
        </form>
    </div>
@endsection
